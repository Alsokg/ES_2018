<div class="toggle-menu">
            <span></span><span></span><span></span>
        </div>
                <nav>
            <ul>
                <?php if ($this->params['val'] == 1 || $this->params['val'] == 111) { ?>
                    <li class="active"><a href="<?="/".Yii::$app->language.""?>"><?= Yii::t('yii', 'CARDS') ?></a></li>
                <?php } else { ?>
                <li><a href="<?="/".Yii::$app->language.""?>"><?= Yii::t('yii', 'CARDS') ?></a></li>
                <?php } if ($this->params['val'] == 2) { ?>
                    <li class="active"><a href="<?= "https://englishstudent.net/app".$menuPostfix; ?>"><?= Yii::t('yii', 'IOS APP') ?></a></li>
                <?php } else { ?>
                <li ><a href="<?= "https://englishstudent.net/app".$menuPostfix; ?>"><?= Yii::t('yii', 'IOS APP') ?></a></li>
                <?php }if ($this->params['val'] == 3) { ?>
                    <li class="active" style="display: none"><a  href=<?="/".Yii::$app->language."/kids"?>><?= Yii::t('yii', 'For Kids') ?></a></li>
                <?php } else { ?>
                <li style="display: none"><a  href="<?="/".Yii::$app->language."/kids"?>"><?= Yii::t('yii', 'For Kids') ?></a></li>
                <?php }if ($this->params['val'] == 'polska') { ?>
                    <li class="active"><a  href=<?="/".Yii::$app->language."/polska"?>><?= Yii::t('yii', 'PolskaPage') ?></a></li>
                <?php } else { ?>
                <li><a  href="<?="/".Yii::$app->language."/polska"?>"><?= Yii::t('yii', 'PolskaPage') ?></a></li>
                <?php }if ($this->params['val'] == 'german' || $this->params['val'] == 'german-cards') { ?>
                    <li class="active"><a  href=<?="/".Yii::$app->language."/german"?>><?= Yii::t('yii', 'GermanPage') ?></a></li>
                <?php } else { ?>
                <li><a  href="<?="/".Yii::$app->language."/german"?>"><?= Yii::t('yii', 'GermanPage') ?></a></li>
                <?php } if ($this->params['val'] == 4) { ?>
                    
                <?php } else {?>
                
                <?php } if ($this->params['val'] == "business") { ?>
                    <li class="active"><a href="<?="/".Yii::$app->language."/business"?>"><?= Yii::t('yii', 'Business') ?></a></li>
                <?php } else { ?>
                <li><a href="<?="/".Yii::$app->language."/business"?>"><?= Yii::t('yii', 'Business') ?></a></li>
                <?php } if ($this->params['val'] == 'test') { ?>
                    <li class="active"><a  href=<?="/".Yii::$app->language."/test"?>><?= Yii::t('yii', 'Test') ?></a></li>
                <?php } else { ?>
                <li><a  href="<?="/".Yii::$app->language."/test"?>"><?= Yii::t('yii', 'Test') ?></a></li>
                <?php }?>
                
            </ul>
        </nav>