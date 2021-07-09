<?php

namespace App\Controller;

use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\Asset;
use Pimcore\Model\Asset\Image;
use Pimcore\Model\Asset\MetaData\ClassDefinition\Data\Data;
use \Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\CarCategory;
use Pimcore\Model\DataObject\Cars;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Event\Event;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends FrontendController
{
    /**
     * @Template
     * @param Request $request
     * @return array
     */
    public function defaultAction(Request $request)
    {
        return [];
    }

//adding an asset in pimcore folder

    /**
     * @Route ("car")
     */
    public function assetAdd()
    {
        $asset = new Asset();
        $asset->setParentId(3);
        $asset->setFilename("audirs6_imported.jpg");
        $asset->setData(file_get_contents("https://img.chceauto.pl/audi/a6/audi-a6-kombi-4472-49497_v2.webp"));
        $asset->save();

        return new Response("done");
    }

//image thumbnail testing
    /**
     * @Route ("thumbnail")
     */
    public function thumbnailAction(Request $request)
    {
        $asset = Asset::getById(6);
        echo $asset->getThumbnail('cars')->getHtml(); die;
        return $this->render('default/thumbnail.html.twig');
    }

//now u can add a document with this controller action in pimcore
    public function carsAction(Request $request)
    {
        //do some stuff here
        return $this->render('default/cars.html.twig');
    }

//url with car objects
    /**
     * @Route("cardata")
     * @return Response
     */
    public function carDataAction(Request $request)
    {
        $cars = new DataObject\Cars\Listing();
        $data = [];

        foreach ($cars as $car) {
            $data[] = [
                'id' => $car->getId(),
                'name' => $car->getName(),
                'price' => $car->getPrice(),
                'description' => $car->getDescription(),
                'gallery' => $car->getGallery(),
            ];
        }
        //return new JsonResponse($data);
        return $this->render('default/cardata.html.twig', ['cars' => $cars]);
    }

    public function areabrickAction(Request $request)
    {
        if ($request->get('type') == 'object') {
            if ($cars = Cars::getById($request->get('id'))) {
                return $this->render('default/car.html.twig', ['cars' => $cars]);
            }
        } else {
            return new Response('error');
        }
    }
}
