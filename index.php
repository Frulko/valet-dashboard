<?php

  
  function p($vars) {
    echo '<pre>';
    var_dump($vars);
    echo '</pre>';
  }

  function d($vars) {
    p($vars);
    die();
  }

  if (isset($_GET['phpinfo'])) {
    phpinfo();
    die();
  }

  if (isset($_GET['path'])) {
    exec('open -a "Finder" ' . $_GET['path']);
    die();
  }

  $valet_xdg_home = getenv('HOME') . '/.config/valet';
  $valet_old_home = getenv('HOME') . '/.valet';
  $valet_home_path = is_dir($valet_xdg_home) ? $valet_xdg_home : $valet_old_home;
  $valet_config = json_decode(file_get_contents("$valet_home_path/config.json"));
  $tld = isset($valet_config->tld) ? $valet_config->tld : $valet_config->domain;

  $tools_link = [
    'https://timber.github.io/docs/' => 'Timber Docs',
    'https://tailwindui.com/' => 'TailwindUI',
    'https://tailwindcss.com/docs/installation' => 'TailwindCSS',
    'http://git.leechy.fr' => 'Gitea',
    'https://github.com/Vas-y-Paulette' => 'Github Organisation',
    'http://phpmyadmin.test/' => 'PHPMyAdmin',
    'https://www.advancedcustomfields.com/resources/' => 'ACF Documentation',
    'http://localhost:8025/' => 'Mailhog',
    'https://www.figma.com' => 'Figma',
    'https://heroicons.com/' => 'Hero Icons',
    'https://docs.google.com/spreadsheets/d/1Wv0Q1dHkslTp-bGZYr-6g81qVRN0AeewDkl-YfpNr2I/edit#gid=1898544504' => '[Drive] Checklist',
    'https://docs.google.com/spreadsheets/d/1jVbTs7K9GLZJymRwYxgWvfChqHg52k6E8TmaHzsK9VU/edit#gid=1895696490' => '[Drive] Drive',
    'https://docs.google.com/spreadsheets/d/1mNeJMCrpT7apf5ZR4LJy-61eZOsbhcZoYWm_YZjPV2U/edit#gid=1869661810' => '[Drive] Sauvegardes',
    'https://app.asana.com/0/home/1138075063883187' => 'Asana'
  ];


  $mysqli = new mysqli("localhost", "root", "hunter2");
  /* Vérification de la connexion */
  if (mysqli_connect_errno()) {
      printf("Échec de la connexion : %s\n", mysqli_connect_error());
      exit();
  }

  $mysql_server_info = $mysqli->server_info;
  $mysqli->close();

  $sites = [];
  $nb = 0;
  foreach ($valet_config->paths as $parked_path){

    foreach (scandir($parked_path) as $site){
      if ($site == basename(__DIR__)): continue; endif;
      if ((is_dir("$parked_path/$site") || is_link("$parked_path/$site")) && $site[0] != '.'){

        $path = str_replace(getenv('HOME'), '~', $parked_path);
        if (empty($sites[$path])) {
          $sites[$path] = [];
        }


        $sites[$path][] = [
          "lastupdate" => filemtime("$parked_path/$site"),
          "path" => "$parked_path/$site",
          "url" => $site . "." . $tld
        ];
        
        
        $nb ++;
      }
    }

    $updates = array_column($sites[$path], 'lastupdate');
    array_multisort($updates, SORT_DESC, $sites[$path]);
  }
  

  
  

 
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="./output.css">
</head>
<body>
  <!-- Background color split screen for large screens -->
<div class="fixed top-0 left-0 w-1/2 h-full bg-white"></div>
<div class="fixed top-0 right-0 w-1/2 h-full bg-gray-50"></div>
<div class="relative flex flex-col min-h-screen">
  <!-- Navbar -->
  <nav class="flex-shrink-0 bg-indigo-700">
    <div class="px-2 mx-auto max-w-7xl sm:px-4 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <!-- Logo section -->
        <div class="flex items-center px-2 lg:px-0">
          <div class="flex-shrink-0">
            <img class="w-auto h-8" src="https://tailwindui.com/img/logos/workflow-mark-on-brand.svg" alt="Workflow logo">
          </div>
        </div>
        <div class="flex items-center justify-start w-full ml-4">
          <div class="flex-shrink-0">
            <h1 class="text-3xl font-bold text-indigo-300 text-extrabold">Valet Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <!--
      Mobile menu, toggle classes based on menu state.

      Menu open: "block", Menu closed: "hidden"
    -->
    <div class="hidden lg:hidden">
      <div class="px-2 pt-2 pb-3">
        <a href="#" class="block px-3 py-2 text-base font-medium text-white transition duration-150 ease-in-out bg-indigo-800 rounded-md focus:outline-none focus:text-indigo-100 focus:bg-indigo-600">Dashboard</a>
        <a href="#" class="block px-3 py-2 mt-1 text-base font-medium text-indigo-200 transition duration-150 ease-in-out rounded-md hover:text-indigo-100 hover:bg-indigo-600 focus:outline-none focus:text-white focus:bg-indigo-600">Support</a>
      </div>
      <div class="pt-4 pb-3 border-t border-indigo-800">
        <div class="px-2">
          <a href="#" class="block px-3 py-2 text-base font-medium text-indigo-200 transition duration-150 ease-in-out rounded-md hover:text-indigo-100 hover:bg-indigo-600 focus:outline-none focus:text-white focus:bg-indigo-600">Your Profile</a>
          <a href="#" class="block px-3 py-2 mt-1 text-base font-medium text-indigo-200 transition duration-150 ease-in-out rounded-md hover:text-indigo-100 hover:bg-indigo-600 focus:outline-none focus:text-white focus:bg-indigo-600">Settings</a>
          <a href="#" class="block px-3 py-2 mt-1 text-base font-medium text-indigo-200 transition duration-150 ease-in-out rounded-md hover:text-indigo-100 hover:bg-indigo-600 focus:outline-none focus:text-white focus:bg-indigo-600">Sign out</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- 3 column wrapper -->
  <div class="flex-grow w-full mx-auto max-w-7xl xl:px-8 lg:flex">
    <!-- Left sidebar & main wrapper -->
    <div class="flex-1 min-w-0 bg-white xl:flex">
      <!-- Account profile -->
      <div class="bg-white xl:flex-shrink-0 xl:w-64 xl:border-r xl:border-gray-200">
        <div class="py-6 pl-4 pr-6 sm:pl-6 lg:pl-8 xl:pl-0">
          <div class="flex items-center justify-between">
            <div class="flex-1 space-y-8">
              <!-- Meta info -->
              <div class="flex flex-col space-y-6 sm:flex-row sm:space-y-0 sm:space-x-8 xl:flex-col xl:space-x-0 xl:space-y-6">

                <div class="flex items-center space-x-2">
                  <!-- Heroicon name: collection -->
                  <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                  </svg>
                  <span class="text-sm font-medium leading-5 text-gray-500"><?php echo $nb; ?> Projects</span>
                </div>
                <div class="flex text-sm font-medium leading-5 text-gray-500" >
                  <svg class="w-5 h-5 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                  </svg>
                  <?php echo 'PHP version : ' . phpversion(); ?>
                </div>
                <div class="flex text-sm font-medium leading-5 text-gray-500" >
                    <svg class="w-5 h-5 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                  <?php echo  $mysql_server_info ?>
                </div>

                <div class="flex text-sm font-medium leading-5 text-gray-600" >
                  <svg class="w-5 h-5 mr-2 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <a href="?phpinfo">PHPInfo</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Projects List -->
      <div class="bg-white lg:min-w-0 lg:flex-1">
        <div class="pt-4 pb-4 pl-4 pr-6 border-t border-b border-gray-200 sm:pl-6 lg:pl-8 xl:pl-6 xl:pt-6 xl:border-t-0">
          <div class="flex items-center">
            <h1 class="flex-1 text-lg font-medium leading-7">Projects</h1>
          </div>
        </div>
        <ul class="relative z-0 border-b border-gray-200 divide-y divide-gray-200">
          <?php foreach ($sites as $path => $sites_path) : ?>
              <li class="pb-3 leading-normal whitespace-no-wrap">
                  <code class="inline-block pt-5 ml-8 font-mono text-gray-600"><?= $path ?></code>
                  <ul class="">
                      <?php foreach ($sites_path as $site) : ?>
                      
                              <li class="relative py-3 pl-4 pr-6 hover:bg-gray-50 sm:py-3 sm:pl-6 lg:pl-8 xl:pl-6">
                                <div class="flex items-center justify-between space-x-4">
                                  <!-- Repo name and link -->
                                  <div class="min-w-0 space-y-3">
                                    <div class="flex items-center space-x-3">
                                      <span aria-label="Running" class="flex items-center justify-center w-4 h-4 bg-green-100 rounded-full">
                                        <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                      </span>

                                      <span class="block">
                                        <h2 class="text-sm font-medium leading-5">
                                          <a href="http://<?= $site['url'] ?>/">
                                            <span class="absolute inset-0"></span>
                                            <?= $site['url'] ?>
                                          </a>
                                          
                                        </h2>
                                      </span>
                                    </div>
                                    <a href="?path=<?= $site['path'] ?>" class="relative group flex items-center space-x-2.5">

                                      <svg class="flex-shrink-0 w-5 h-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                      </svg>
                                      <div class="ml-3 text-sm font-medium leading-5 text-gray-500 truncate group-hover:text-gray-900">
                                      <?= $site['path'] ?>
                                      </div>
                                    </a>
                                  </div>
                                  <div class="sm:hidden">
                                    <!-- Heroicon name: chevron-right -->
                                    <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                  </div>
                                  <!-- Repo meta info -->
                                  <div class="flex-col items-end flex-shrink-0 hidden space-y-3 sm:flex">
                                    <p class="flex items-center space-x-4">
                                      <a href="http://<?= "$site.$tld" ?>/" class="relative text-sm font-medium leading-5 text-gray-500 hover:text-gray-900">
                                        Visit site
                                      </a>
                                    </p>
                                    <!-- <p class="flex space-x-2 text-sm leading-5 text-gray-500">
                                      <span>Laravel</span>
                                      <span>&middot;</span>
                                      <span>Last deploy 3h ago</span>
                                    </p> -->
                                  </div>
                                </div>
                              </li>
                      <?php endforeach ?>
                  </ul>
              </li>
          <?php endforeach ?>
          

          <!-- More items... -->
        </ul>
      </div>
    </div>
    <!-- Activity feed -->
    <div class="pr-4 bg-gray-50 sm:pr-6 lg:pr-8 lg:flex-shrink-0 lg:border-l lg:border-gray-200 xl:pr-0">
      <div class="pl-6 lg:w-80">
        <div class="pt-6 pb-2">
          <h2 class="text-sm font-semibold leading-5">Tools</h2>
        </div>
        <div>
          <ul class="divide-y divide-gray-200">
            <?php
              foreach ($tools_link as $link => $name) {
                ?>
                <li class="py-4">
                  <div class="flex space-x-3">
                    <div class="flex-1 space-y-1">
                      <div class="flex items-center justify-between">
                        <h3 class="mr-10 text-sm font-medium leading-5"><?php echo $name; ?></h3>
                        <a href="<?php echo $link; ?>" target="blank" class="text-sm leading-5 text-gray-500" style="width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $link; ?></a>
                      </div>
                    </div>
                  </div>
                </li>
            
                <?php
              }
            
            ?>
            

            

          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>