<?php

namespace App\Services;

use Treinetic\ImageArtist\lib\PolygonShape;
use Treinetic\ImageArtist\lib\Shapes\Square;
use Treinetic\ImageArtist\lib\Text\TextBox;
use Treinetic\ImageArtist\lib\Text\Color;
use Treinetic\ImageArtist\lib\Text\Font;
use Treinetic\ImageArtist\lib\Overlays\Overlay;
use Treinetic\ImageArtist\lib\Image;
use Treinetic\ImageArtist\lib\Shapes\Triangle;

class ImageService
{
    public function createCapa(array $imagens)
    {
        //
        /*   dd($imagens); */
        /*
        foreach ($imagens as $key => $img) {
            $imagem[$key] = new Triangle($img);
        }


 */

        $imagem[0] =  new Triangle($imagens[0]);
        $imagem[1] =  new Triangle($imagens[0]);

           dd($imagem);



       /*  $imagem[0]->scale(40);
        $imagem[0]->setPointA(0, 0, true);
        $imagem[0]->setPointB(100, 0, true);
        $imagem[0]->setPointC(100, 100, true);
        $imagem[0]->build();

        $imagem[1]->scale(40);
        $imagem[1]->setPointA(0, 0, true);
        $imagem[1]->setPointB(0, 100, true);
        $imagem[1]->setPointC(100, 100, true);
        $imagem[1]->build();

        $imagem[0]->resize($imagem[0]->getWidth(), $imagem[1]->getHeight());

        $img = $imagem[0]->merge($imagem[1], 0, 0);
        $img->scale(70);

        $img->save('storage/img/capa.jpg');
        $img->dump(); */
    }
}
