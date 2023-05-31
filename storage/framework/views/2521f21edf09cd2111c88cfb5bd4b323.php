<?php
if(isset($id)){var_dump($id);}
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('/css/Contribute.css')); ?>">
    <script src="js/UploadImage.js" type="text/javascript" defer></script>
</head>
<body>
    <?php echo $__env->make('Profile_Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrap">
        <?php echo $__env->make('Profile_Side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main_column">
            <div class="prof_outline">
                <form action="/Contribute" method="POST" enctype="multipart/form-data" class="upload_form"> 
                    <?php echo csrf_field(); ?>
                    <div class="img_upload">
                        <div class="upload">
                            <h2>完成写真のアップロード</h2>
                            <!-- （3）formタグで送信したfile情報はここに表示 -->
                            <div class="flex">
                                <img id="picture" src="\images\noimage.png">
                                <div>
                                    <!-- （2）input 属性はtype="file" と指定-->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                    <input id="image" multiple name="file[]" type="file" accept="image/*" class="top_picture">
                                    <!-- 送信ボタン -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mid_info">
                            <div class="mid">
                                <p class="red"><?php if(isset($_SESSION['error']['recipe']['title'])){echo $_SESSION['error']['recipe']['title'];} ?></p>
                                <label for="title">タイトル:</label>
                                <input type="title" name="title" maxlength="100">
                            </div>
                            <div class="mid">
                                <p class="red"><?php if(isset($_SESSION['error']['recipe']['comment'])){echo $_SESSION['error']['recipe']['comment'];} ?></p>
                                <label for="comment">コメント:</label>
                                <input type="comment" name="comment" maxlength="200">
                            </div>
                            <div class="mid">
                                <label for="level">難易度:</label>
                                <select name="level">
                                    <option value="1">★☆☆☆☆</option>
                                    <option value="2">★★☆☆☆</option>
                                    <option value="3">★★★☆☆</option>
                                    <option value="4">★★★★☆</option>
                                    <option value="5">★★★★★</option>
                                </select>
                            </div>
                    </div>
                    <div class="material">
                        <h2>必要材料</h2>
                        <p class="red"><?php if(isset($_SESSION['error']['material']['ma'])){echo $_SESSION['error']['material']['ma'];} ?></p>
                        <p class="red"><?php if(isset($_SESSION['error']['material']['qua'])){echo $_SESSION['error']['material']['qua'];} ?></p>
                        <div class="grid">
                            <div class="flex">
                                <h3>1</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <h3>2</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <h3>3</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <h3>4</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <h3>5</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <h3>6</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <h3>7</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <h3>8</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <h3>9</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <h3>10</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <h3>11</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <h3>12</h3>
                                <div>
                                    <div>
                                        <div>
                                            <label>材料:</label>
                                            <input type="material" name="ma[]">
                                        </div>
                                        <div>
                                            <label>分量:</label>
                                            <input type="quanity" name="qua[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="procedure">
                        <h2>手順</h2>
                        <p class="red"><?php if(isset($_SESSION['error']['tejun'])){echo $_SESSION['error']['tejun'];} ?></p>
                        <div class="proce_grid">
                            <div class="flex">
                                <h3>1</h3>
                                <div>
                                    <img class="proce_img" id="picture_2" src="\images\noimage.png">
                                    <p>写真を選択</p>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                    <input id="image_2" multiple name="file[]" type="file" accept="image/*">
                                    <div class="down">
                                        <p>手順コメント</p>
                                        <textarea type="procedure" name="procedure[]"></textarea>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="flex">
                                <h3>2</h3>
                                <div>
                                    <img class="proce_img" id="picture_3" src="\images\noimage.png">
                                    <p>写真を選択</p>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                    <input id="image_3" multiple name="file[]" type="file" accept="image/*">
                                    <div class="down">
                                        <p>手順コメント</p>
                                        <textarea type="procedure" name="procedure[]"></textarea>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="flex">
                                <h3>3</h3>
                                <div>
                                    <img class="proce_img" id="picture_4" src="\images\noimage.png">
                                    <p>写真を選択</p>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                    <input id="image_4" multiple name="file[]" type="file" accept="image/*">
                                    <div class="down">
                                        <p>手順コメント</p>
                                        <textarea type="procedure" name="procedure[]"></textarea>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="flex">
                                <h3>4</h3>
                                <div>
                                    <img class="proce_img" id="picture_5" src="\images\noimage.png">
                                    <p>写真を選択</p>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                    <input id="image_5" multiple name="file[]" type="file" accept="image/*">
                                    <div class="down">
                                        <p>手順コメント</p>
                                        <textarea type="procedure" name="procedure[]"></textarea>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="flex">
                                <h3>5</h3>
                                <div>
                                    <img class="proce_img" id="picture_6" src="\images\noimage.png">
                                    <p>写真を選択</p>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                    <input id="image_6" multiple name="file[]" type="file" accept="image/*">
                                    <div class="down">
                                        <p>手順コメント</p>
                                        <textarea type="procedure" name="procedure[]"></textarea>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="flex">
                                <h3>6</h3>
                                <div>
                                    <img class="proce_img" id="picture_7" src="\images\noimage.png">
                                    <p>写真を選択</p>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                    <input id="image_7" multiple name="file[]" type="file" accept="image/*">
                                    <div class="down">
                                        <p>手順コメント</p>
                                        <textarea type="procedure" name="procedure[]"></textarea>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="submit">
                            <input id="submit" type="submit" value="上記内容を確認">
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\Cook_Beginers_Recipe\resources\views/Contribute.blade.php ENDPATH**/ ?>