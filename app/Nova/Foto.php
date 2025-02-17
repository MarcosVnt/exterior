<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\TextArea;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\DateTime;

use Rotunova2\MailCard\MailCard;
use Rotunova2\FotosultimasCard\FotosultimasCard;
use Illuminate\Support\Facades\Storage;
//use Intervention\Image\ImageManager;

use Laravel\Nova\Fields\Text;

use R64\NovaImageCropper\ImageCropper;

use DmitryBubyakin\NovaMedialibraryField\Fields\MediaLibrary;

use App\ObraFoto;

class Foto extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\ObraFoto';
    public static $group = 'Tablas';


    public static $perPageOptions = [50, 100, 150];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','texto'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {

      //  dd($request);
        return [
            ID::make()->sortable(),
            BelongsTo::make('user')
            ->searchable()
            ->sortable()
            ->rules('required'), 

            BelongsTo::make('obra')
            ->sortable()
            ->rules('required'), 
      /*       Gravatar::make(), */
/*             Image::make('Foto ds')->disk('public')->path('obra/images'),
 */

 Image::make('imagen')->disk('public')
 ->path('obra/images'),
    
 /*   07/06 todo no carga , no rota       
 ImageCropper::make('imagen')
                      ->disk('public')
                      ->path('obra/images')
                      ->maxWidth(300)
                      ->preview(function () {

                        $url = Storage::disk($this->disk)->url($this->value);
                        dd($url,$this->request,$this->value,$this->disk);

                          if (!$this->value) return null;
  
    
                          $url = Storage::disk($this->disk)->url($this->value);

                          dd('not value',$url);
                          
                          $filetype = pathinfo($url)['extension'];
                          return 'data:image/' . $filetype . ';base64,' . base64_encode(file_get_contents($url));
                      
  
                  }),  */
                     /*  ->store(function (Request $request, $model) {
                      return [
                          'attachment' => $request->attachment->store('/obra', 'public'),
                          'attachment_name' => $request->attachment->getClientOriginalName(),
                          'attachment_size' => $request->attachment->getSize(),
                      ];
                          }
                      )  */
          /*   Image::make('foto')
            ->disk('public')
            ->path('obra')
            ->store(function (Request $request, $model) {
                return [
                    'attachment' => $request->attachment->store('/obra', 'public'),
                    'attachment_name' => $request->attachment->getClientOriginalName(),
                    'attachment_size' => $request->attachment->getSize(),
                ];
            }),  */
      Textarea::make('texto')
          ->sortable(),

          DateTime::make('created_at')
          ->format('YYYY-MM-DD HH:mm')
          ->sortable(), 
        /*   Text::make('slug')->sortable(), */
      /* Text::make('slug')->resolveUsing(function ($slug){
          return '€'.'auth()->user()->name'.'€';
      })->sortable()
          ->rules('required'),  */
        
        /*   BelongsTo::make('Obra'), */


        //Medialibrary::make('obra_fotos')->sortable(),
        //Medialibrary::make('Featured Image', 'obra_fotos', ObraFoto::class),
        
     

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new MailCard)->width('full')->onlyOnDetail(),
            //(new CardUltimasFotos)->width('full')->onlyOnDetail(),
            //(new FotosultimasCard)->width('full')->onlyOnDetail(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [            
            new Filters\FiltroPorObra,
             ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
