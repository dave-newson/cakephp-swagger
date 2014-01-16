<?php

use Swagger\Swagger as Swagger;

/**
 * Class SwaggerController
 * Provides API documentation via Swagger-PHP JSON interface
 */
class SwaggerController extends AppController
{
    public $uses = array();

    public $viewClass = 'Json';


    /**
     * Generates Swagger-PHP JSON documentation
     * Uses Configuration from "swagger.paths"
     * - Produces a specific resource if $resource is specified.
     * - Produces a ResourceList if no $resource is specified
     *
     * @param	string      Resource label
     * @return  string
     */
    function generateDocumentation( $resource=null )
    {
        // Prevent regular output method
        $this->autoRender = false;

        // Build file list from paths
        $pathList = Configure::read('swagger.paths');
        $fileList = array();

        if (is_array($pathList) && sizeof($pathList))
        {
            // Get all files in directories
            foreach ($pathList as $path) {
                if ($handle = opendir($path)) {
                    while (false !== ($entry = readdir($handle))) {

                        // Get the full path of this file
                        $filePath = $path.DS.$entry;

                        // If not a directory - use it!
                        if ($entry != "." && $entry != ".." && !is_dir($filePath)) {
                            $fileList[] = $filePath;
                        }
                    }
                }
            }
        }

        // Create swagger, indexing any given files
        $swagger = new Swagger($fileList);       

        // Fetching a specific resource?
        if ( !empty($resource) ) {
            $data = $swagger->getResource('/'.$resource);
        }
        // Fetch the resource listing
        else
        {
            $data = $swagger->getResourceList();
            $data['basePath'] = Router::url('/', true);
        }

        // output
        $this->set($data);
        $this->set('_serialize', array_keys($data));
        $this->render();
    }
}
