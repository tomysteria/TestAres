<?php

namespace Ares\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ares\CoreBundle\Entity\Chrono;
use Ares\CoreBundle\Form\ChronoType;

/**
 * Chrono controller.
 *
 * @Route("/chrono")
 */
class ChronoController extends Controller
{

    /**
     * Lists all Chrono entities.
     *
     * @Route("/", name="chrono")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AresCoreBundle:Chrono')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Chrono entity.
     *
     * @Route("/", name="chrono_create")
     * @Method("POST")
     * @Template("AresCoreBundle:Chrono:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Chrono();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('chrono_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Chrono entity.
     *
     * @param Chrono $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Chrono $entity)
    {
        $form = $this->createForm(new ChronoType(), $entity, array(
            'action' => $this->generateUrl('chrono_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Chrono entity.
     *
     * @Route("/new", name="chrono_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Chrono();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Chrono entity.
     *
     * @Route("/{id}", name="chrono_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AresCoreBundle:Chrono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chrono entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Chrono entity.
     *
     * @Route("/{id}/edit", name="chrono_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AresCoreBundle:Chrono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chrono entity.');
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
    * Creates a form to edit a Chrono entity.
    *
    * @param Chrono $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Chrono $entity)
    {
        $form = $this->createForm(new ChronoType(), $entity, array(
            'action' => $this->generateUrl('chrono_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Chrono entity.
     *
     * @Route("/{id}", name="chrono_update")
     * @Method("PUT")
     * @Template("AresCoreBundle:Chrono:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AresCoreBundle:Chrono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chrono entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('chrono_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Chrono entity.
     *
     * @Route("/{id}", name="chrono_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AresCoreBundle:Chrono')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Chrono entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('chrono'));
    }

    /**
     * Creates a form to delete a Chrono entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chrono_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
