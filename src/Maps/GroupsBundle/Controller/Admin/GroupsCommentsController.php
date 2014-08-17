<?php

namespace Maps\GroupsBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Maps\GroupsBundle\Entity\GroupsComments;
use Maps\GroupsBundle\Form\GroupsCommentsType;

/**
 * GroupsComments controller.
 *
 * @Route("/admin/groups_comments")
 */
class GroupsCommentsController extends Controller
{

    /**
     * Lists all GroupsComments entities.
     *
     * @Route("/", name="groupscomments")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MapsGroupsBundle:GroupsComments')->findBy(array(), array('id' => 'DESC'));

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Creates a new GroupsComments entity.
     *
     * @Route("/", name="groupscomments_create")
     * @Method("POST")
     * @Template("MapsGroupsBundle:GroupsComments:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new GroupsComments();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('groupscomments_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a GroupsComments entity.
     *
     * @param GroupsComments $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(GroupsComments $entity)
    {
        $form = $this->createForm(new GroupsCommentsType(), $entity, array(
            'action' => $this->generateUrl('groupscomments_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new GroupsComments entity.
     *
     * @Route("/new", name="groupscomments_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new GroupsComments();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a GroupsComments entity.
     *
     * @Route("/{id}", name="groupscomments_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MapsGroupsBundle:GroupsComments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GroupsComments entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing GroupsComments entity.
     *
     * @Route("/{id}/edit", name="groupscomments_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MapsGroupsBundle:GroupsComments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GroupsComments entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a GroupsComments entity.
     *
     * @param GroupsComments $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(GroupsComments $entity)
    {
        $form = $this->createForm(new GroupsCommentsType(), $entity, array(
            'action' => $this->generateUrl('groupscomments_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing GroupsComments entity.
     *
     * @Route("/{id}", name="groupscomments_update")
     * @Method("PUT")
     * @Template("MapsGroupsBundle:GroupsComments:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MapsGroupsBundle:GroupsComments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GroupsComments entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('groupscomments_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a GroupsComments entity.
     *
     * @Route("/{id}", name="groupscomments_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MapsGroupsBundle:GroupsComments')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GroupsComments entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('groupscomments'));
    }

    /**
     * Creates a form to delete a GroupsComments entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('groupscomments_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
