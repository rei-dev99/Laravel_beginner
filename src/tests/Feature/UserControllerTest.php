<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->createUser();
        $user = \App\Models\User::all()->first();
        $response = $this->get('/users');

        $this->checkCommonDisplay($response);
        $response->assertSee($user->name, true, "一覧ページにユーザー名を表示してください");
        $response->assertSee($user->age, true, "一覧ページに年齢を表示してください");
    }

    public function test_show()
    {
        $this->createUser();
        $user = \App\Models\User::select('*')->orderBy('id', 'desc')->first();
        $response = $this->get("/users/{$user->id}");

        $this->checkCommonDisplay($response);

        $response->assertSee($user->name, true, "詳細ページにユーザー名を表示してください");
        $response->assertSee($user->age, true, "詳細ページに年齢を表示してください");
    }

    public function test_create()
    {
        $response = $this->get("/users/create");
        $this->checkCommonDisplay($response);
    }

    public function test_storeSuccess()
    {
        $attributes = [
            'name' => 'らんてくん',
            'age' => 20,
        ];
        $response = $this->post("/users", $attributes);
        $user = \App\Models\User::select('*')->orderBy('id', 'desc')->first();

        $response->assertStatus(302);
        $response->assertRedirect(route("users.show", $user));

        $this->assertSame($user->name, 'らんてくん');
        $this->assertSame($user->age, 20);
    }

    private function createUser(int $num = 1)
    {
        $count = 0;

        while($count < $num) {
            $user = new User();
            $user->name = "らんてくん{$num}";
            $user->age = $num;
            $user->save();

            $count += 1;
        }
    }

    private function checkCommonDisplay($response)
    {
        $response->assertStatus(200);
        $attributes = ['ユーザー名', '年齢'];
        foreach ($attributes as $attribute) {
            $response->assertSee($attribute, true, "{$attribute}という文字を表示するようにしてください");
        }
    }
}
