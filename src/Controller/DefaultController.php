<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\Asset;
use \Pimcore\Model\DataObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends FrontendController
{
    /**
     * @Template
     * @param Request $request
     * @return array
     */
    public function defaultAction(Request $request)
    {

    }

//adding an asset in pimcore folder

    /**
     * @Route ("car")
     */
    public function assetAdd()
    {
        $asset = new Asset();
        $asset->setParentId(2);
        $asset->setFilename("audirs6_imported.jpg");
        $asset->setData(file_get_contents("https://i.pinimg.com/originals/cc/89/52/cc8952ed3f57e6f72b4e843035489021.jpg"));
        $asset->save();

        return new Response("done");
    }
}
