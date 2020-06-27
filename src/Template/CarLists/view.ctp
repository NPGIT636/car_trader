<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CarList $carList
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Car List'), ['action' => 'edit', $carList->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Car List'), ['action' => 'delete', $carList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carList->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Car Lists'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Car List'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Carts'), ['controller' => 'Carts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cart'), ['controller' => 'Carts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="carLists view large-9 medium-8 columns content">
    <h3><?= h($carList->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($carList->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $carList->has('user') ? $this->Html->link($carList->user->name, ['controller' => 'Users', 'action' => 'view', $carList->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Car Price') ?></th>
            <td><?= h($carList->car_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($carList->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Sold') ?></th>
            <td><?= $carList->is_sold ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $carList->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $carList->deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Carts') ?></h4>
        <?php if (!empty($carList->carts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Tax') ?></th>
                <th scope="col"><?= __('Car List Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($carList->carts as $carts): ?>
            <tr>
                <td><?= h($carts->id) ?></td>
                <td><?= h($carts->user_id) ?></td>
                <td><?= h($carts->price) ?></td>
                <td><?= h($carts->tax) ?></td>
                <td><?= h($carts->car_list_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Carts', 'action' => 'view', $carts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Carts', 'action' => 'edit', $carts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Carts', 'action' => 'delete', $carts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $carts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
