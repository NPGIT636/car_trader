<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CarList[]|\Cake\Collection\CollectionInterface $carLists
 */
?>
<?=$this->element('menu');?>
<div class="carLists index large-9 medium-8 columns content">
    <h3><?= __('Car Lists') ?></h3>
	<?=$this->element('search');?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('car_price') ?></th>
               

                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carLists as $carList): ?>
            <tr>
                <td><?= $this->Number->format($carList->id) ?></td>
                <td><?= h($carList->name) ?></td>
                <td><?= $carList->has('user') ? $this->Html->link($carList->user->name, ['controller' => 'Users', 'action' => 'view', $carList->user->id]) : '' ?></td>
                <td><?= h($carList->car_price) ?></td>
              
                <td class="actions">
                   
                  <?php if(($carList->is_sold!=1)){ ?> <?= $this->Html->link(__('Buy Now'), ['controller'=>'Carts','action' => 'add', $carList->id]) ?> <?php }else{?><?php echo "Out of Stock";}?>
                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
