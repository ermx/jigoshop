<?php
use Jigoshop\Admin\Helper\Forms;
use Jigoshop\Helper\Currency;
use Jigoshop\Helper\Product;

/**
 * @var $order \Jigoshop\Entity\Order The order.
 * @var $shippingMethods array List of available shipping methods.
 */
?>
<div class="jigoshop jigoshop-order">
	<div class="form-horizontal">
		<table class="table table-striped">
			<thead>
			<tr>
				<th scope="col"><?php _e('ID', 'jigoshop'); ?></th>
				<th scope="col"><?php _e('SKU', 'jigoshop'); ?></th>
				<th scope="col"><?php _e('Name', 'jigoshop'); ?></th>
				<th scope="col"><?php printf(__('Unit price (%s)', 'jigoshop'), Currency::symbol()); ?></th>
				<th scope="col"><?php _e('Quantity', 'jigoshop'); ?></th>
				<th scope="col"><?php _e('Price', 'jigoshop'); ?></th>
				<th scope="col"></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($order->getItems() as $item): /** @var $item \Jigoshop\Entity\Order\Item */ $id = $item->getId(); ?>
			<tr>
				<td class="id"><?php Forms::constant(array('name' => 'order[items]['.$id.'][id]', 'value' => $id)); ?></td>
				<td class="sku"><?php Forms::constant(array('name' => 'order[items]['.$id.'][sku]', 'value' => $item->getProduct()->getSku())); ?></td>
				<td class="name"><?php Forms::constant(array('name' => 'order[items]['.$id.'][name]', 'value' => $item->getName())); ?></td>
				<td class="price"><?php Forms::text(array('name' => 'order[items]['.$id.'][price]', 'value' => Product::formatNumericPrice($item->getPrice()))); ?></td>
				<td class="quantity"><?php Forms::text(array('name' => 'quantity['.$id.']', 'value' => $item->getQuantity())); ?></td>
				<td class="total"><?php Forms::constant(array('name' => 'order[items]['.$id.'][total]', 'value' => Product::formatPrice($item->getCost()))); ?></td>
				<td class="actions">
					<a href="" class="close"><span aria-hidden="true">&times;</span><span class="sr-only"><?php _e('Remove', 'jigoshop'); ?></span></a>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="3"><?php Forms::text(array('name' => 'new_item', 'id' => 'new-item', 'placeholder' => __('Search for products...', 'jigoshop'))); ?></td>
				<td><button class="btn btn-primary" id="add-item"><?php _e('Add item', 'jigoshop'); ?></button></td>
				<td class="text-right"><strong><?php _e('Product subtotal:', 'jigoshop'); ?></strong></td>
				<td id="product-subtotal"><?php echo Product::formatPrice($order->getProductSubtotal()); ?></td>
				<td></td>
			</tr>
			</tfoot>
		</table>
	</div>
</div>