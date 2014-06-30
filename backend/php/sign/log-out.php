<?php

# ...
@session_start();
@session_destroy();

return_to(ROOT.'/backend/sign');

?>