<?php

namespace App;

use App\UploadableTrait;

use Illuminate\Database\Eloquent\Model;
use illuminate\Http\UploadedFile;
use illuminate\Support\Collection;

class Image extends Model
{
    use UploadableTrait;

    protected $fillable = [
        'projet_id',
        'src',
        'observation'
    ];

    function projet(){

        return $this->belongsTo('App\Projet');
    }

    public static function saveImages($projectId,Collection $collection,$obs){
        $projet = Projet::find($projectId);
        $collection->each(function(UploadedFile $file) use ($projectId,$projet,$obs){
         //   $filename = $this->storeFile($file);
            $filename =  $file->store('projets', ['disk' => 'public']);
            $image = new Image([
                'projet_id'=> $projectId,
                'src'=> $filename,
                'observation'=>$obs
            ]);
            $projet->images()->save($image);
        });
    }
    //
}
