<aside class="main-sidebar">
    <section class="sidebar">
        <?
         $callback = function ($menu) {
            return [
                'label' => $menu['name'],
                'icon' => $menu['icon'] ? $menu['icon'] : '',
                'url' => \common\modules\rbac\components\MenuHelper::parseRoute($menu['route']),
                'items' => $menu['children']
            ];
        };
        $menus = \common\modules\rbac\components\MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback);
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' =>  $menus
            ]
        ) ?>
    </section>
</aside>
<script>
    $( document ).ready(function() {
        $('.sidebar-toggle').bind('click', function(){
            var collapse = '';
            var classList = $('.sidebar-mini').eq(0).attr('class').split(/\s+/);
            $.each(classList, function(index, item) {
                if (item === 'sidebar-collapse') {
                    collapse = item;
                }
            });

            if(collapse == '') {
                $.cookie('collapse', 1);
            } else {
                $.removeCookie('collapse');
            }
        });
    });
</script>