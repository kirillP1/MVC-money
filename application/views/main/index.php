<div class="container">
    <h1 class="my-4">Тарифы</h1>
    <div class="row">
        <?foreach($tariffs as $key => $val):?>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h3 class="card-header"><?echo $val['title'];?></h3>
                    <div class="card-body">
                        <div class="display-4"><?echo $val['percent'];?> %</div>
                        <div class="font-italic"><?echo $val['description'];?></div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Минимальная инвестиция: <?echo $val['min'];?> $</li>
                        <li class="list-group-item">Максимальная инвестиция: <?echo $val['max'];?> $</li>
                        <li class="list-group-item">Период инвестиции: <?echo $val['hour'];?> ч.</li>
                        <li class="list-group-item">    
                        <?if(isset($_SESSION['account']['id'])): ?>                 
                            <a href="/dashboard/invest/<?echo $key;?>" class="btn btn-primary">Инвестировать</a>
                        <?else:?>
                             <a href="/account/login" class="btn btn-primary">Войдите для инвестирования</a>
                        <?endif?>
                        </li>
                    </ul>
                </div>
            </div>
        <?endforeach;?>
    </div>
</div>