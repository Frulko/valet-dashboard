<?php
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
  ]
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
<div class="relative min-h-screen flex flex-col">
  <!-- Navbar -->
  <nav class="flex-shrink-0 bg-indigo-700">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <!-- Logo section -->
        <div class="flex items-center px-2 lg:px-0 xl:w-64">
          <div class="flex-shrink-0">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-on-brand.svg" alt="Workflow logo">
          </div>
        </div>
        <div class="flex items-center justify-center w-full">
          <div class="flex-shrink-0">
            <h1 class="text-white text-extrabold text-3xl">Dashboard</h1>
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
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-indigo-800 focus:outline-none focus:text-indigo-100 focus:bg-indigo-600 transition duration-150 ease-in-out">Dashboard</a>
        <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-indigo-200 hover:text-indigo-100 hover:bg-indigo-600 focus:outline-none focus:text-white focus:bg-indigo-600 transition duration-150 ease-in-out">Support</a>
      </div>
      <div class="pt-4 pb-3 border-t border-indigo-800">
        <div class="px-2">
          <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-indigo-200 hover:text-indigo-100 hover:bg-indigo-600 focus:outline-none focus:text-white focus:bg-indigo-600 transition duration-150 ease-in-out">Your Profile</a>
          <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-indigo-200 hover:text-indigo-100 hover:bg-indigo-600 focus:outline-none focus:text-white focus:bg-indigo-600 transition duration-150 ease-in-out">Settings</a>
          <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-indigo-200 hover:text-indigo-100 hover:bg-indigo-600 focus:outline-none focus:text-white focus:bg-indigo-600 transition duration-150 ease-in-out">Sign out</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- 3 column wrapper -->
  <div class="flex-grow w-full max-w-7xl mx-auto xl:px-8 lg:flex">
    <!-- Left sidebar & main wrapper -->
    <div class="flex-1 min-w-0 bg-white xl:flex">
      <!-- Account profile -->
      <div class="xl:flex-shrink-0 xl:w-64 xl:border-r xl:border-gray-200 bg-white">
        <div class="pl-4 pr-6 py-6 sm:pl-6 lg:pl-8 xl:pl-0">
          <div class="flex items-center justify-between">
            <div class="flex-1 space-y-8">
              <!-- Meta info -->
              <div class="flex flex-col space-y-6 sm:flex-row sm:space-y-0 sm:space-x-8 xl:flex-col xl:space-x-0 xl:space-y-6">

                <div class="flex items-center space-x-2">
                  <!-- Heroicon name: collection -->
                  <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                  </svg>
                  <span class="text-sm text-gray-500 leading-5 font-medium">8 Projects</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Projects List -->
      <div class="bg-white lg:min-w-0 lg:flex-1">
        <div class="pl-4 pr-6 pt-4 pb-4 border-b border-t border-gray-200 sm:pl-6 lg:pl-8 xl:pl-6 xl:pt-6 xl:border-t-0">
          <div class="flex items-center">
            <h1 class="flex-1 text-lg leading-7 font-medium">Projects</h1>
          </div>
        </div>
        <ul class="relative z-0 divide-y divide-gray-200 border-b border-gray-200">
          <?php foreach ($valet_config->paths as $parked_path) : ?>
              <li class="leading-normal whitespace-no-wrap pb-3">
                  <code class="inline-block ml-8 pt-5 font-mono text-gray-600"><?= str_replace(getenv('HOME'), '~', $parked_path) ?></code>
                  <ul class="">
                      <?php foreach (scandir($parked_path) as $site) : ?>
                          <?php if ($site == basename(__DIR__)): continue; endif ?>
                          <?php if ((is_dir("$parked_path/$site") || is_link("$parked_path/$site")) && $site[0] != '.') : ?>

                              <li class="relative pl-4 pr-6 py-3 hover:bg-gray-50 sm:py-3 sm:pl-6 lg:pl-8 xl:pl-6">
                                <div class="flex items-center justify-between space-x-4">
                                  <!-- Repo name and link -->
                                  <div class="min-w-0 space-y-3">
                                    <div class="flex items-center space-x-3">
                                      <span aria-label="Running" class="h-4 w-4 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="h-2 w-2 bg-green-400 rounded-full"></span>
                                      </span>

                                      <span class="block">
                                        <h2 class="text-sm font-medium leading-5">
                                          <a href="http://<?= "$site.$tld" ?>/">
                                            <span class="absolute inset-0"></span>
                                            <?= "$site.$tld" ?>
                                          </a>
                                        </h2>
                                      </span>
                                    </div>
                                    <!-- <a href="#" class="relative group flex items-center space-x-2.5">
                                      <svg class="flex-shrink-0 w-5 h-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99917 0C4.02996 0 0 4.02545 0 8.99143C0 12.9639 2.57853 16.3336 6.15489 17.5225C6.60518 17.6053 6.76927 17.3277 6.76927 17.0892C6.76927 16.8762 6.76153 16.3104 6.75711 15.5603C4.25372 16.1034 3.72553 14.3548 3.72553 14.3548C3.31612 13.316 2.72605 13.0395 2.72605 13.0395C1.9089 12.482 2.78793 12.4931 2.78793 12.4931C3.69127 12.5565 4.16643 13.4198 4.16643 13.4198C4.96921 14.7936 6.27312 14.3968 6.78584 14.1666C6.86761 13.5859 7.10022 13.1896 7.35713 12.965C5.35873 12.7381 3.25756 11.9665 3.25756 8.52116C3.25756 7.53978 3.6084 6.73667 4.18411 6.10854C4.09129 5.88114 3.78244 4.96654 4.27251 3.72904C4.27251 3.72904 5.02778 3.48728 6.74717 4.65082C7.46487 4.45101 8.23506 4.35165 9.00028 4.34779C9.76494 4.35165 10.5346 4.45101 11.2534 4.65082C12.9717 3.48728 13.7258 3.72904 13.7258 3.72904C14.217 4.96654 13.9082 5.88114 13.8159 6.10854C14.3927 6.73667 14.7408 7.53978 14.7408 8.52116C14.7408 11.9753 12.6363 12.7354 10.6318 12.9578C10.9545 13.2355 11.2423 13.7841 11.2423 14.6231C11.2423 15.8247 11.2313 16.7945 11.2313 17.0892C11.2313 17.3299 11.3937 17.6097 11.8501 17.522C15.4237 16.3303 18 12.9628 18 8.99143C18 4.02545 13.97 0 8.99917 0Z" fill="currentcolor" />
                                      </svg>
                                      <div class="text-sm leading-5 ml-3 text-gray-500 group-hover:text-gray-900 font-medium truncate">
                                        debbielewis/workcation
                                      </div>
                                    </a> -->
                                  </div>
                                  <div class="sm:hidden">
                                    <!-- Heroicon name: chevron-right -->
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                  </div>
                                  <!-- Repo meta info -->
                                  <div class="hidden sm:flex flex-col flex-shrink-0 items-end space-y-3">
                                    <p class="flex items-center space-x-4">
                                      <a href="http://<?= "$site.$tld" ?>/" class="relative text-sm leading-5 text-gray-500 hover:text-gray-900 font-medium">
                                        Visit site
                                      </a>
                                    </p>
                                    <!-- <p class="flex text-gray-500 text-sm leading-5 space-x-2">
                                      <span>Laravel</span>
                                      <span>&middot;</span>
                                      <span>Last deploy 3h ago</span>
                                    </p> -->
                                  </div>
                                </div>
                              </li>
                          <?php endif ?>
                      <?php endforeach ?>
                  </ul>
              </li>
          <?php endforeach ?>
          

          <!-- More items... -->
        </ul>
      </div>
    </div>
    <!-- Activity feed -->
    <div class="bg-gray-50 pr-4 sm:pr-6 lg:pr-8 lg:flex-shrink-0 lg:border-l lg:border-gray-200 xl:pr-0">
      <div class="pl-6 lg:w-80">
        <div class="pt-6 pb-2">
          <h2 class="text-sm leading-5 font-semibold">Tools</h2>
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
                        <h3 class="text-sm font-medium leading-5 mr-10"><?php echo $name; ?></h3>
                        <a href="<?php echo $link; ?>" target="blank" class="text-sm leading-5 text-gray-500"><?php echo $link; ?></a>
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