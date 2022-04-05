<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Albums;
use App\Form\AlbumsType;

class AlbumsController extends AbstractController
{
    #[Route('/', name: 'albums')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $albums = $doctrine->getRepository(Albums::class)->findAll();
        return $this->render('albums/index.html.twig',['albums'=> $albums]);
    }

    #[Route('/create', name: 'albums_create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $album = new Albums();
        $form = $this->createForm(AlbumsType::class, $album);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $album = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($album);
            $em->flush();

            $this->addFlash(
                'notice','Album added'
            );
            return $this->redirectToRoute('albums');
        }
        return $this->render('albums/create.html.twig',['form'=>$form->createView()]);
    }
    #[Route('/edit/{id}', name: 'albums_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $album = $doctrine->getRepository(Albums::class)->find($id);
        $form = $this->createForm(AlbumsType::class,$album);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $album = $form->getData();
            $em = $doctrine -> getManager();
            $em ->persist($album);
            $em->flush();
            $this->addFlash(
                'notice',
                'Album added'
            );
            return $this->redirectToRoute('albums');
        }
        return $this->render('albums/edit.html.twig',['form'=> $form->createView()]);
    }

    #[Route('/details/{id}', name: 'albums_details')]
    public function details(ManagerRegistry $doctrine, $id): Response
    {
        $album = $doctrine->getRepository(Albums::class)->find($id);
        return $this->render('albums/details.html.twig',['album'=>$album]);
    }
    #[Route('/delete/{id}', name:'album_delete')]
    public function delete(ManagerRegistry $doctrine,$id){
        $em = $doctrine->getManager();
        $album = $em-> getRepository('App:Albums')->find($id);
        $em->remove($album);

        $em->flush();
        $this->addFLash(
            'notice',
            'Album removed(('
        );
        return $this->redirectToRoute('albums');
    
    }
}
