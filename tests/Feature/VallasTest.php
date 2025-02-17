<?php

namespace Tests\Feature;

use App\Propietario;
use App\Terreno;
use App\Valla;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Laravel\Nova\Tests\Fixtures\Post;

class VallasTest extends TestCase
{


    use RefreshDatabase;


    public function setup() : void{
        parent::setUp();

        $this->propietario    = factory(Propietario::class)->create(); 
        $this->terreno    = factory(Terreno::class)->create(['propietario_id' => $this->propietario->id]);

        $valla = factory(Valla::class)->create(['terreno_id' => $this->terreno->id]);


    }
    

    //https://tonyfrenzy.medium.com/part-2-testing-model-relationships-in-laravel-basic-8b606dd36c02

/*    
cinco test dos siguentes funciones
1. User schema test 
2. Phone schema test
3. User->hasOne(phone) test (2 methods)
4. Phone->belongsTo(user) test */

    
    /** @test */
    public function propietario_tiene_terrenos(){
       // $propietario = factory(Propietario::class)->create();
       // $terreno = factory(Terreno::class)->create(['propietario_id' => $propietario]);
       
        $this->assertInstanceOf(Terreno::class, $this->terreno);
        $this->assertEquals(1,$this->propietario->terrenos->count());
    }

      /** @test */
      public function terreno_pertenece_propietario(){
        //$propietario = factory(Propietario::class)->create();
        //$terreno = factory(Terreno::class)->create(['propietario_id' => $propietario]);

        $this->assertInstanceOf(Propietario::class, $this->terreno->propietario);
    }



    /** @test */
    public function posts_database_has_expected_columns()
    {
        $this->assertTrue( 
        Schema::hasColumns('propietarios', [
            'id','dni', 'nombre', 'direccion'
        ]), 1);
    }

 /** @test */
    public function propietario_has_many_vallas()
    {
       // $propietario    = factory(Propietario::class)->create(); 
       // $terreno    = factory(Terreno::class)->create(['propietario_id' => $propietario->id]);

        //$valla = factory(Valla::class)->create(['terreno_id' => $terreno->id]);
   
        // Method 1: A comment exists in a post's comment collections.
        $this->assertTrue($this->terreno->vallas->contains($this->valla));
        
        // Method 2: Count that a post comments collection exists.
        $this->assertEquals(1, $this->terreno->vallas->count());

        // Method 3: Comments are related to posts and is a collection instance.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->terreno->vallas);
    }

    /** @test */
    public function una_valla_belongs_to_a_terreno()
    {
        //$propietario    = factory(Propietario::class)->create(); 
        //$terreno    = factory(Terreno::class)->create(['propietario_id' => $propietario->id]);
        //$valla = factory(Valla::class)->make(['terreno_id' => $terreno->id]);
   
       
        // Method 2: Count that a post comments collection exists.
     //  dd( $valla->terreno->count());
        $this->assertEquals(1, $this->valla->terreno->count());

        // Method 3: Comments are related to posts and is a collection instance.
        $this->assertInstanceOf(Terreno::class, $this->valla->terreno);
    }


    /** @test */
    // tienen muchos a traves de    
    public function una_propietario_has_an_valla_through_terreno()
    {
       // $propietario    = factory(Propietario::class)->create(); 
       // $terreno    = factory(Terreno::class)->create(['propietario_id' => $propietario->id]);
       // $valla = factory(Valla::class)->make(['terreno_id' => $terreno->id]);
   
       
        // Method 2: Count that a post comments collection exists.
      // dd( $this->propietario);
        $this->assertEquals(1, $this->propietario->vallas->count());

        // Method 3: Comments are related to posts and is a collection instance.
       // $this->assertInstanceOf(Valla::class, $this->propietario->vallas);
    }


}


//hasOnethrouth  -- tiene uno a traves de -.. un p