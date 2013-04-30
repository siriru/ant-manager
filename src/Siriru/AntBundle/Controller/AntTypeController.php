<?php

namespace Siriru\AntBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Siriru\AntBundle\Entity\AntType;
use Siriru\AntBundle\Form\AntTypeType;

/**
 * AntType controller.
 *
 * @Route("/anttype")
 */
class AntTypeController extends Controller
{
    /**
     * Lists all AntType entities.
     *
     * @Route("/", name="anttype")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiriruAntBundle:AntType')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new AntType entity.
     *
     * @Route("/", name="anttype_create")
     * @Method("POST")
     * @Template("SiriruAntBundle:AntType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new AntType();
        $form = $this->createForm(new AntTypeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('anttype_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new AntType entity.
     *
     * @Route("/new", name="anttype_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AntType();
        $form   = $this->createForm(new AntTypeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AntType entity.
     *
     * @Route("/{id}", name="anttype_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiriruAntBundle:AntType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AntType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AntType entity.
     *
     * @Route("/{id}/edit", name="anttype_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiriruAntBundle:AntType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AntType entity.');
        }

        $editForm = $this->createForm(new AntTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing AntType entity.
     *
     * @Route("/{id}", name="anttype_update")
     * @Method("PUT")
     * @Template("SiriruAntBundle:AntType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiriruAntBundle:AntType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AntType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AntTypeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('anttype_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a AntType entity.
     *
     * @Route("/{id}", name="anttype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiriruAntBundle:AntType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AntType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('anttype'));
    }

    /**
     * Creates a form to delete a AntType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
