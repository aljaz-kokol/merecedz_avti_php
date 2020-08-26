<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once VIEW."shared/meta_data.php";
        require_once VIEW."shared/css.php";
    ?>
    <title>Reviews</title>
</head>
<body>
    <?php require_once VIEW."shared/nav.php" ?>
    <main>
        <h1>Reviews</h1>
         <section class="reviews-list">
             <form action="" method="POST">
                 <input type="hidden" name="_method" value="DELETE">
                 <?php foreach($this->listAvtov as $avto) : ?>
                    <article class='card comment-card'>
                       <a href="/details/<?= $avto->id ?>"><img class='news-card-img' src='../<?= $avto->getImg()->img_dir?>' alt='<?= $avto->getImg()->ime ?>'></a>
                        <div class='news-card-content'>
                            <h2 class='news-card-title'>Komentarji</h2>
                            <ul class="comment-list">
                                <?php if($avto->numOfReviews() > 0) : ?>
                                    <?php foreach($avto->getReviews() as $komentar) : ?>
                                        <li <?php if(isset($this->viewData['uporabnik'])) echo "onmousedown='showDelBox()'" ?>  class="comment">
                                            <?php if($this->uporabnik !== null && $komentar->fk_uporabnik_id === $this->uporabnik->id) : ?>
                                                    <input type="checkbox" class="del-box" name="delete[]" value="<?= $komentar->id ?>">
                                            <?php endif ?>
                                            <h4 class="username"><?= $komentar->getUser()->username ?></h4>
                                            <p class="comment-message"><?= $komentar->besedilo ?></p>
                                            <div class="comment-rating">
                                                <?php
                                                    for($i = 0; $i < $komentar->ocena; $i++)
                                                        echo "<span class='color-star star'></span>";

                                                    for($i = 0; $i < (5 - $komentar->ocena); $i++)
                                                        echo "<span class='empty-star star'></span>";
                                                ?>
                                            </div>
                                            <p class="news-card-date">Objavljeno: <?= $komentar->getDate() ?></p>
                                        </li>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <p class="fill-comment">Nihče še ni komentiral in ocenil tega vozila</p>
                                <?php endif ?>
                            </ul>
                        </div>
                        <div class="rating">
                            <h2>Povprečna ocena: <?= $avto->ime ?></h2>
                            <?php
                                for($i = 0; $i < $avto->averageGrade(); $i++)
                                    echo "<span class='color-star star'></span>";

                                for($i = 0; $i < (5 - $avto->averageGrade()); $i++)
                                    echo "<span class='empty-star star'></span>";
                            ?>
                        </div>
                    </article>
                 <?php endforeach ?>
                 <button id="del-select" onclick="showDelMsg(event)" name="del-btn">
                     <i class="fa fa-trash-o" id="trash-img"></i>
                 </button>
                 <div id="del-msg">
                     <h2 id="del-msg-title">Izbris komentarjev</h2>
                     <p id="del-msg-des">Ste prepricani da zelite izbrisati naslednje komentarje</p>
                     <ul class="comment-list"></ul>
                     <div class="center">
                         <input type="submit" name='del-btn' value="Da" class="btn black">
                         <input type="button" onclick="cancle()" value="Ne" class="btn black">
                     </div>
                 </div>
            </form>
         </section>
         <div class="full-overlay"></div>
    </main>
    <?php include VIEW."shared/footer.php" ?>
    <script>
        let delBoxes = document.querySelectorAll('.del-box');
        let timeOut;
        let komentarji = [];
        function showDelBox(){
            let delBtn = document.getElementById('del-select');            
            timeOut = setTimeout(
              () => {
                delBoxes.forEach((box)=>{ box.style.display = 'block';})
                delBtn.style.display = 'initial';
              },
              1000
            )
        }

        function stopShowDelBox(){
            clearTimeout(timeOut);
        }

        function showDelMsg(e){
            e.preventDefault();
            let counter = 0;
            let delMsg = document.getElementById('del-msg');
            let overlay = document.querySelector('.full-overlay');
            let commentList = delMsg.querySelector('.comment-list');
            
            delBoxes.forEach((delBox)=>{
                if(delBox.checked === true){
                    counter++;
                    let parentElm = delBox.parentElement;
                    let username = parentElm.querySelector('.username').cloneNode(true);
                    let comment = parentElm.querySelector('.comment-message').cloneNode(true);
                    let rating = parentElm.querySelector('.comment-rating').cloneNode(true);
                    let date = parentElm.querySelector('.news-card-date').cloneNode(true);
                    
                    let newLi = document.createElement('li');
                    newLi.className = 'comment';
                    newLi.appendChild(username);
                    newLi.appendChild(comment);
                    newLi.appendChild(rating);
                    newLi.appendChild(date);
                    commentList.appendChild(newLi);
                }
            });
            if(counter !== 0){
                delMsg.style.display = 'block';
                overlay.style.display = 'block';
            }
        }
        
        function cancle(){
            let delMsg = document.getElementById('del-msg');
            let commentList = delMsg.querySelector('.comment-list');
            let overlay = document.querySelector('.full-overlay');
            delMsg.style.display = 'none';
            overlay.style.display = 'none';
            commentList.querySelectorAll('*').forEach(child => child.remove());
        }
    </script>
</body>
</html>