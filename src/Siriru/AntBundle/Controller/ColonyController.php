<?php

namespace Siriru\AntBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Siriru\AntBundle\Entity\Colony;
use Siriru\AntBundle\Form\Type\ColonyType;

/**
 * Colony controller.
 */
class ColonyController extends Controller
{
    /**
     * Lists all Colony entities owned by current user.
     *
     * @Route("/colonies", name="user_colonies")
     * @Method("GET")
     * @Template("SiriruAntBundle:Colony:user-colonies.html.twig")
     */
    public function userColoniesAction(){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $entities = $em->getRepository('SiriruAntBundle:Colony')->findByUser($user);
        
        return array(
                'entities' => $entities,
        );
    }
    
    /**
     * Finds and displays a Colony entity owned by current user.
     *
     * @Route("/colony/{id}", name="user_colony")
     * @Method("GET")
     * @Template("SiriruAntBundle:Colony:user-colony.html.twig")
     */
    public function userColonyAction($id)
    {
        $em = $this->getDoctrine()->getManager();
    
        $entity = $em->getRepository('SiriruAntBundle:Colony')->find($id);
        
        if($entity->getUser() != $this->getUser()) {
            throw new AccessDeniedException('This is not your colony');
        }
    
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Colony entity.');
        }
    
        $deleteForm = $this->createDeleteForm($id);
    
        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Lists all Colony entities.
     *
     * @Route("/admin/colonies", name="colonies")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiriruAntBundle:Colony')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Colony entity.
     *
     * @Route("/admin/colonies", name="colony_create")
     * @Method("POST")
     * @Template("SiriruAntBundle:Colony:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Colony();
        $form = $this->createForm(new ColonyType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('colony_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Colony entity.
     *
     * @Route("admin/colony/new", name="colony_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Colony();
        $form   = $this->createForm(new ColonyType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Colony entity.
     *
     * @Route("admin/colony/{id}", name="colony_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiriruAntBundle:Colony')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Colony entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Colony entity.
     *
     * @Route("admin/colony/{id}/edit", name="colony_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiriruAntBundle:Colony')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Colony entity.');
        }

        $editForm = $this->createForm(new ColonyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Colony entity.
     *
     * @Route("admin/colony/{id}", name="colony_update")
     * @Method("PUT")
     * @Template("SiriruAntBundle:Colony:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiriruAntBundle:Colony')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Colony entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ColonyType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('colony_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Colony entity.
     *
     * @Route("admin/colony/{id}", name="colony_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiriruAntBundle:Colony')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Colony entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('colony'));
    }

    /**
     * Creates a form to delete a Colony entity by id.
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
