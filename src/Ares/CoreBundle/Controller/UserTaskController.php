<?php

namespace Ares\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ares\CoreBundle\Entity\UserTask;
use Ares\CoreBundle\Form\UserTaskType;

/**
 * UserTask controller.
 *
 * @Route("/usertask")
 */
class UserTaskController extends Controller
{

    /**
     * Lists all UserTask entities.
     *
     * @Route("/", name="usertask")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AresCoreBundle:UserTask')->findAll();

        
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new UserTask entity.
     *
     * @Route("/", name="usertask_create")
     * @Method("POST")
     * @Template("AresCoreBundle:UserTask:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new UserTask();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usertask_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a UserTask entity.
     *
     * @param UserTask $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserTask $entity)
    {
        $form = $this->createForm(new UserTaskType(), $entity, array(
            'action' => $this->generateUrl('usertask_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserTask entity.
     *
     * @Route("/new", name="usertask_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new UserTask();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a UserTask entity.
     *
     * @Route("/{id}", name="usertask_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AresCoreBundle:UserTask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserTask entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing UserTask entity.
     *
     * @Route("/{id}/edit", name="usertask_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AresCoreBundle:UserTask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserTask entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a UserTask entity.
    *
    * @param UserTask $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserTask $entity)
    {
        $form = $this->createForm(new UserTaskType(), $entity, array(
            'action' => $this->generateUrl('usertask_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserTask entity.
     *
     * @Route("/{id}", name="usertask_update")
     * @Method("PUT")
     * @Template("AresCoreBundle:UserTask:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AresCoreBundle:UserTask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserTask entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('usertask_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a UserTask entity.
     *
     * @Route("/{id}", name="usertask_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AresCoreBundle:UserTask')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserTask entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('usertask'));
    }

    /**
     * Creates a form to delete a UserTask entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usertask_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
