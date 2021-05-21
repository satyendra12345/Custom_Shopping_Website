<?php

namespace app\components;

use alexantr\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class TRichTextEditor extends CKEditor
{

    public $enableKCFinder = true;
    
    
    public $clientOptions = [
        'extraPlugins' => 'autogrow,colorbutton,colordialog,iframe,justify,showblocks',
        'removePlugins' => 'resize',
        'autoGrow_maxHeight' => 900,
    ];
    
    /**
     * Registers CKEditor plugin
     */
    protected function registerPlugin()
    {
        if ($this->enableKCFinder) {
            $this->registerKCFinder();
        }
        
        parent::registerPlugin();
    }

    /**
     * Registers KCFinder
     */
    protected function registerKCFinder()
    {
       $browseOptions = [
            'filebrowserImageBrowseUrl' => Url::to([
                '/file/ckeditor',
                'filter' => 'image'
            ]),
            
            'filebrowserImageUploadUrl' => Url::to([
                '/file/upload'
            ])
        ];
        
        $this->clientOptions = ArrayHelper::merge($browseOptions, $this->clientOptions);

    }

    public $preset;
}