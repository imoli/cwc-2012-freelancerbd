<div class="widget">

                <h4>Whose are attending ?</h4>
                <p>
                    <?php
                    $id=(int)$_GET['id'];
                    $attend = App::getRepository('Attend')->getAllAttende($id);
                    if($attend){
                        foreach($attend as $person){
                            $hash=md5(strtolower(trim($person['email'])));
                            echo "<img src='http://www.gravatar.com/avatar/{$hash}?s=30' title='{$person['email']}'/>";
                        }
                    }
                    ?>
                </p>


            </div>