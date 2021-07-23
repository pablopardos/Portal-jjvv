<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacion', function (Blueprint $table) {
            $table->increments('id_pub');
            $table->integer('id_tipopub')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->string('asunto', 100)->nullable();
            $table->longText('descrip', 5000)->nullable();

            $table->foreign('id_tipopub')->references('id_tipopub')->on('tipopublicacion');
            $table->foreign('id_user')->references('id_user')->on('users');
        });
        DB::table('publicacion')->insert(array('id_pub'=>'1','id_tipopub'=>'1','id_user'=>'1','asunto'=>'Hola Mundo','descrip'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut volutpat odio. Phasellus molestie convallis ex at egestas. Fusce ut justo ultrices, suscipit dolor eu, viverra libero. Quisque vestibulum lacinia cursus. Phasellus posuere eros at velit maximus bibendum. Nullam pretium egestas dignissim. Curabitur blandit tempor ligula, sed vulputate ante ultrices in. Nulla at eleifend ipsum. Praesent egestas auctor odio sit amet semper. Donec convallis, lorem at suscipit pulvinar, augue quam hendrerit mauris, eu mattis dolor tortor id justo. Sed efficitur efficitur metus, at facilisis odio tincidunt non. Cras commodo vehicula velit ac sollicitudin.

        Nullam eget massa lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed bibendum laoreet finibus. Ut lorem nibh, viverra vel odio eget, suscipit condimentum quam. Etiam imperdiet tortor diam, eu pharetra lorem tempor id. Pellentesque eu hendrerit nulla. Morbi quis congue velit, ac condimentum magna. Ut tristique sem posuere risus placerat bibendum. Suspendisse scelerisque turpis a lectus maximus gravida. Cras ac elit est. Sed quis nisi a urna pretium pulvinar. Fusce eu sollicitudin metus. Curabitur a lorem mollis, rhoncus magna eu, bibendum eros. Quisque efficitur vestibulum velit, at dictum sapien ornare ultrices. Fusce in elit id lectus dapibus mattis. Mauris tincidunt posuere lorem, vitae pharetra turpis viverra vel.
        
        Aliquam ut fermentum dolor, sit amet pharetra odio. Integer sit amet dolor urna. Quisque at massa finibus, commodo nulla vel, malesuada sem. Phasellus massa purus, facilisis vel purus a, semper pharetra tellus. Quisque vitae metus ut mauris efficitur scelerisque auctor nec erat. Sed urna metus, euismod eu risus sit amet, sodales fermentum est. In nulla arcu, eleifend a blandit id, ullamcorper sed arcu. Duis quis lacinia dui. Nullam dictum varius felis, a malesuada neque molestie at. Vivamus viverra, ligula id vestibulum laoreet, urna arcu laoreet ex, et egestas nunc elit in erat. Mauris ultrices, ligula sit amet porttitor tincidunt, mi tellus auctor diam, vulputate iaculis dui sapien quis nisl. Cras sed dolor a nunc efficitur congue sed et velit. Proin convallis dolor eu commodo pulvinar.
        
        Praesent bibendum sed neque quis vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent pulvinar tempus libero in luctus. In condimentum gravida velit, et commodo eros imperdiet in. Morbi scelerisque in lacus ut accumsan. Phasellus mattis risus dictum est tempor, a imperdiet velit euismod. Mauris mollis, diam at vulputate maximus, purus augue pharetra leo, vel cursus sapien tortor eu libero. Duis volutpat erat non ex consequat, vulputate ultricies enim consequat. Donec interdum sagittis enim a pulvinar. Donec volutpat, eros eu accumsan tincidunt, ex ligula commodo mi, blandit laoreet erat velit non enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed non luctus ipsum, ut ullamcorper.'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicacion');
    }
}
