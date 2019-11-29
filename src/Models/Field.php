<?php


namespace TalentuI33\ActiveCampaign\Models;


class Field
{
    public $id = null;
    public $title = null;
    public $description = null;
    public $type = null;
    public $is_required = null;
    public $per_stag = null;
    public $def_val = null;
    public $show_in_list = null;
    public $rows = null;
    public $cols = null;
    public $visible = null;
    public $service = null;
    public $order_num = null;
    public $c_date = null;
    public $u_date = null;
    public $options = null;
    public $relations = null;
    public $links = [];

    public static function create(array $metaData): self
    {
        $meta = new self();


        $meta->id = $metaData['id'];
        $meta->title = $metaData['title'];
        $meta->description = $metaData['description'];
        $meta->type = $metaData['type'];
        $meta->is_required = $metaData['isrequired'];
        $meta->per_stag = $metaData['perstag'];
        $meta->def_val = $metaData['defval'];
        $meta->show_in_list = $metaData['show_in_list'];
        $meta->rows = $metaData['rows'];
        $meta->cols = $metaData['cols'];
        $meta->visible = $metaData['visible'];
        $meta->service = $metaData['service'];
        $meta->order_num = $metaData['ordernum'];
        $meta->c_date = $metaData['cdate'];
        $meta->u_date = $metaData['udate'];
        $meta->options = $metaData['options'];
        $meta->relations = $metaData['relations'];
        $meta->links = $metaData['links'];

        return $meta;
    }
}
