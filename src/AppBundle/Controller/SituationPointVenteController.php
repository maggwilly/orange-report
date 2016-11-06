<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SituationPointVente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Situationpointvente controller.
 *
 */
class SituationPointVenteController extends Controller
{
    /**
     * Lists all situationPointVente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $situationPointVentes = $em->getRepository('AppBundle:SituationPointVente')->findAll();

        return $this->render('situationpointvente/index.html.twig', array(
            'situationPointVentes' => $situationPointVentes,
        ));
    }

    /**
     * Creates a new situationPointVente entity.
     *
     */
    public function newAction(Request $request, PointVente $pointVente)
    {
        $situationPointVente = new Situationpointvente();        
       $normalizer = new ObjectNormalizer();       
       $content = $request->getContent();
        if (!empty($content)){
         $data = json_decode($content, true); 
         $em = $this->getDoctrine()->getManager();                  
        $situationPointVente= $normalizer->denormalize($data, 'AppBundle\Entity\Situationpointvente'); 
        $situationPointVente->setPointVente(pointVente)->setDateSave(new \DateTime())  ;      
        $em->persist($situationPointVente);
         $em->flush($situationPointVente);
         $response = new JsonResponse(['success' => true], 200);
         $response->headers->set('Content-Type', 'application/json');
         return $response;         
        } 
        $response = new JsonResponse(array('action' => 'goToNewPage' ), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Finds and displays a situationPointVente entity.
     *
     */
    public function showAction(SituationPointVente $situationPointVente)
    {
        $deleteForm = $this->createDeleteForm($situationPointVente);

        return $this->render('situationpointvente/show.html.twig', array(
            'situationPointVente' => $situationPointVente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing situationPointVente entity.
     *
     */
    public function editAction(Request $request, SituationPointVente $situationPointVente)
    {
        $normalizer = new ObjectNormalizer();       
        $content = $request->getContent();
        if (!empty($content)){
          $data = json_decode($content, true);                   
         $situationPointVente= $normalizer->denormalize($data, 'AppBundle\Entity\Situationpointvente');
         $situationPoint->setId($situationPointVente->getId());
         $em = $this->getDoctrine()->getManager();
         $em->persist($situationPoint);
         $em->flush($situationPoint);
           $response = new JsonResponse(['success' => true,'situationPointVente' => $situationPointVente], 200);
           $response->headers->set('Content-Type', 'application/json');
          return $response;         
        }    
        $response = new JsonResponse(array('action' => 'goToEditPage','pointVente' => $pointVente), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;  
    }

    /**
     * Deletes a situationPointVente entity.
     *
     */
    public function deleteAction(Request $request, SituationPointVente $situationPointVente)
    {
         try{  
            $em = $this->getDoctrine()->getManager();
            $em->remove($situationPointVente);
            $em->flush($situationPointVente);

             } catch(Exception $e){
               $response = new JsonResponse(['success' => false], 500);
               $response->headers->set('Content-Type', 'application/json');
         return $response;     
      } 

          $response = new JsonResponse(['success' => true], 200);
          $response->headers->set('Content-Type', 'application/json');
          return $response;  
    }

    /**
     * Creates a form to delete a situationPointVente entity.
     *
     * @param SituationPointVente $situationPointVente The situationPointVente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SituationPointVente $situationPointVente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('situationpointvente_delete', array('id' => $situationPointVente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}