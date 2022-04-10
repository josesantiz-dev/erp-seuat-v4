<?php
   class Logout
   {
      public function __construct()
      {
         session_start(); // Inicializamos la sesión
         session_unset(); // Limpiamos todas las variables de sesión
         session_destroy(); // Destruimos todas las sesiones
         header('location: '.base_url().'/login');
      }
   }
?>