<?php
defined( 'ABSPATH' ) || exit;
?>

<h2 class="heading heading--md">Breeder Details</h2>

<?php
    $user_id=get_field('pet_lister_user_id');
    um_fetch_user( $user_id );
    $breeder_name=um_user('Breeder_Name');
    um_user('city')?$location=um_user('city').', '.um_user('State').um_user('province'):$location=um_user('State').um_user('province');
?>

<h3 class="heading heading--sm">Name</h3>
<p><?php echo $breeder_name;?></p>

<hr>

<h3 class="heading heading--sm">Location</h3>
<p><?php echo $location;?></p>

<hr>

<h3 class="heading heading--sm">Additional Information</h3>

<div class="breeder-details">
<?php
    $fields = array(
        'health_guarantee'=>'health_guarantee_description',
        'free_shipping'=>'free_shipping_details',
        'returns'=>'returns_details',
        'training'=>'training_details',
        'vaccines'=>'vaccine_details',
        'registration_included'=>'registration_details'
    );
    $breeder_details_output='';
    foreach($fields as $k=>$v){
        $q=get_field($k);
        $detail=get_field($v);
        if($q||$detail){
            $breeder_details_output.="<div class='breeder-details__tab-card {$k}'>";
            $label=str_replace('_',' ',$k);
            $q?$breeder_details_output.="<p class='label'>{$label}</p><p class='value'>{$q}</p>":"";
            $labelDetail=str_replace('_',' ',$v);
            $detail?$breeder_details_output.="<p class='label'>{$labelDetail}</p><p class='value'>{$detail}</p>":"";
            $breeder_details_output.="</div>";
        }
    }
    echo $breeder_details_output;
?>
</div>

<a class="btn btn--primary" href='/breeder-profile/?bid=<?php echo $user_id;?>'>LEARN MORE ABOUT THIS BREEDER</a>