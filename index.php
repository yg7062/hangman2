<?php
require 'autoload.php';
$user = $middleware->guest();
$categories = $db->select('SELECT id, name from categories')->get();
?>
<html lang="en">
<head>
    <title>Hangman</title>
    <?php require 'includes/header.php' ?>
</head>
<body onload="playMusic()">
   <div class="full-bg">
      <div class="controls">
         <button onclick="toggleMusic(this)" title="Mute"><span class="glyphicon glyphicon-volume-up"></span></button>
         <?php if ($user) : ?>
            <button onclick="game.changeStatus(1)" title="Resume Game"><span class="glyphicon glyphicon-play"></span></button>
<?php endif; ?>

      </div>
      <div class="vertical-middle">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 text-center">
                  <div class="title">
                     <h1>Hangman</h1>
                     <small>Famous Childhood Game</small>
                  </div>
                  <img src="images/hangman-game.png" width="200px" alt="">
               </div>
            </div>
            <br> <br>
            <div class="row">
               <div class="col-sm-12 text-center">
                  <button data-toggle="modal" data-target="#categoryModal" class="btn btn-success" type="button">Start Game</button>
                  <button data-toggle="modal" data-target="#rulesModal"  class="btn btn-warning" type="button">Help ?</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="categoryModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Select Category</h4>
            </div>
            <form action="#" id="gameForm" method="post">
               <div class="modal-body">
                  <div class="form-group">
                     <select name="category" class="form-control">
                        <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Proceed</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>

    <div id="rulesModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Game Rules</h4>
            </div>

            <div class="modal-body">
                <ul>
                    <li>Click on Start Game.</li>
                    <li>Select Category & Proceed</li>
                    <li>Now You have to Guess a Random Word (10 Chances).</li>
                    <li>Click on Alphabet and and it will filled in blank if correct, otherwise a body part of hangman will be drawn.</li>
                    <li>Once word is completed you will be moved to next level, There are total 10 Levels.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <?php require 'includes/footer.php' ?>
</body>
</html>