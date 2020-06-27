<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cart Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $price
 * @property string $tax
 * @property int $car_list_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\CarList $car_list
 */
class Cart extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'price' => true,
        'tax' => true,
        'car_list_id' => true,
        'user' => true,
        'car_list' => true,
    ];
}
