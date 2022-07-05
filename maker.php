<?php

print_r($argv);

function controller(){
echo 'c';
}

function model(){
  echo 'm';
}

function view(){
  echo 'v';
}

if ($argv[1] == '-c'){
 controller();
} else if ($argv[1] == '-m'){
  model();
} else if ($argv[1] == '-v'){
  view();
} else if ($argv[1] == '-cmv'){
  controller();
  model();
  view();
}