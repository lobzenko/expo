<ul class="nav navbar-nav">
    <li class="nav-item"><a class="nav-link" href="/"><img src="/i/logo.png" alt="" height="22"></a></li>
    <?php foreach ($menu as $key => $item)
    {
        $hasRole = true;
        
        if (!empty($item['roles']))
        {
            foreach ($item['roles'] as $rkey => $role)
                if (!Yii::$app->user->can($role))
                {
                    $hasRole = false;
                    break;
                }
        }

        if (!$hasRole)
            continue;

        $active = '';

        if (isset($item['submenu']))
        {
            $active = (Yii::$app->controller->id==$key || (isset($item['submenu'][Yii::$app->controller->id])))?'active':'';            

            echo '<li class="nav-item dropdown '.$active.'">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="bx me-2 '.$item['icon'].'"></i> <span>'.$item['title'].'</span> <div class="arrow-down"></div></a>
                    <div class="dropdown-menu">';

            foreach ($item['submenu'] as $skey=>$child)
            {
                $active = ($active_url==$skey)?'active':'';

                echo '<a class="dropdown-item" href="/master/'.$skey.'">'.$child['title'].'</a>';                
            }

            echo "</div>";
        }
        else
            echo '<li class="nav-item dropdown  '.$active.'"><a class="nav-link noti-icon " href="/master/'.$key.'"><i class="bx me-2 '.$item['icon'].'"> </i> <span>'.$item['title'].'</span>'.(!empty($item['count'])?'<span class="label label-warning pull-right">'.$item['count'].'</span>':'').'</a></li>';
    }?>
</ul>