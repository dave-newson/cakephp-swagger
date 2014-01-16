# Swagger CakePHP Module

A quick implementation to provide Swagger documentation as a CakePHP plugin

## Usage

 * Clone this repository to your Plugin folder within your CakePHP 2.x application.

 * Add the following to your Config.bootstrap.php file
    CakePlugin::load( array( 'Swagger' => array( 'routes' => true, 'bootstrap'=>true ) ) );