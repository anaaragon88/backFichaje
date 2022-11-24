<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


use App\Entity\Entrada;
use App\Entity\User;
use App\Repository\EntradaRepository;
use DateTime;

class ApiEntradaController extends AbstractController
{
    public function __controller(EntradaRepository $entradaRepository) 
    {
        $this->entradaRepository = $entradaRepository;
    }

    #[Route('/api/entrada', name: 'app_api_entrada',  methods: ['POST'])]
    public function crear(Request $request, ManagerRegistry $doctrine): JsonResponse
    {   
        $data = json_decode($request->getContent(), true);
        
        $fecha_publicacion = $data['fecha_publicacion'];
        $comentario = $data['comentario'];
        $locacion = $data['locacion'];
        $userId = $data['user'];
    
        $em = $doctrine->getManager();
        $entrada = new Entrada();

        
        // $entrada->setUser($user);
        //$fecha_formato = \DateTime::createFromInterface($fecha_publicacion);
        //$fecha_formato = \DateTime::createFromFormat('d/m/Y, H:i:s', $fecha_publicacion);
        //dump($fecha_formato);die;
        $datetime = \DateTime::createFromFormat('d-m-Y H:i:s', $fecha_publicacion);
        
        //11/21/2022, 12:02:09 PM
        //$dtime = DateTime::createFromFormat("d/m/Y H:i:s", $fecha_publicacion);
        //$timestamp = \Datetime::createFromFormat("Y/m/d H:i:s", $fecha_publicacion);
        //$fecha_formato = $datetime->createFromFormat('d/m/Y H:i:s', $fecha_publicacion);
        //dump($fecha_formato);die;

        //$fecha_formato = DateTime::createFromFormat('d/m/Y H:i:s',$fecha_publicacion);
        
        
        //dump($entrada->setFechaPublicacion($datetime));die;
        $entrada->setFechaPublicacion($datetime);
        $entrada->setComentario($comentario);
        $entrada->setLocacion($locacion);
        
        // $entrada->setUser($this->getUser());


        $user = $this->getUsuario($userId, $doctrine);
        $entrada->setUser($user);
        $em->persist($entrada);
        $em->flush();

        return $this->json('Ha fichado exitosamente', $status = 200, $headers = ['Access-Control-Allow-Origin'=>'*', 'Access-Control-Allow-Methods'=> 'POST,OPTIONS']);
        //return $this->json('Ha fichado exitosamente ' . $entrada->getId());
    }

    public function getUsuario(int $id, ManagerRegistry $doctrine){
        // $sql = "SELECT * FROM user WHERE id = ?";
        // $stmt = $this->connect()->prepare($sql);
        // $stmt->execute(array($id));

        // $resultado = $stmt->fetch();

        $em = $doctrine->getManager();
        $usuario = $em->getRepository(User::class)->find($id);
        return $resultado;
    }


    // /**
    //  * @Route("/entrada/{id}", name="VerEntrada")
    //  */
    // #[Route('/entrada/{id}', name: 'verEntrada')]
    // public function VerEntrada($id, Request $request, ManagerRegistry $doctrine)
    // {
    //     $em = $doctrine->getManager();
    //     $entrada = $em->getRepository(Entrada::class)->find($id);
    //     return ['entrada' => $entrada];
    // } 
}