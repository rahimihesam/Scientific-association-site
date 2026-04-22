<?php

// HTTP Redirect
function redirect($url)
{
  header("Location: $url");
  exit;
}
