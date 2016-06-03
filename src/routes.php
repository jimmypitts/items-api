<?php
// Routes

$this->get('/api/item/[{id}]', function ($request, $response, $args) {

    $item = Model_Item::get_by_id($args['id']);
    if (!$item)
    {
        return $response->write(json_encode(array('status' => 'Error')))->withStatus(404);
    }

    return $response->write(json_encode($item->to_array()));
});

$this->get('/api/items', function ($request, $response, $args) {

    $seller = $request->getQueryParam('seller');
    $category = $request->getQueryParam('category');

    $res = array();
    $items = Model_Item::get_items_by_seller_and_category($seller, $category);
    foreach ($items as $item)
    {
        $res[] = $item->to_array();
    }
    $response->write(json_encode(array('items' => $res)));
});