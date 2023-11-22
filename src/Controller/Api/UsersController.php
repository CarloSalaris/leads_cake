<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Firebase\JWT\JWT;
use Cake\Utility\Security;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $privateKey = 'secret_key';
            $user = $result->getData();
            $payload = [
                'iss' => 'myapp',
                'sub' => $user->id,
                'exp' => time() + 60,
            ];
            $json = [
                'token' => JWT::encode($payload, $privateKey, 'HS256'),
            ];
        } else {
            $this->response = $this->response->withStatus(401);
            $json = [];
        }
        $this->set(compact('json'));
        $this->viewBuilder()->setOption('serialize', 'json');
        /* $this->request->allowMethod(['get', 'post']);

        $result = $this->Authentication->getResult();

        logd($result);

        if ($result->isValid()) {

            $user = $result->getData();

            $token = $this->_generateJwtToken($user);

            $this->set([
                'status' => true,
                'message' => 'Login successful',
                'token' => $token,
            ]);
        } else {
            $this->set([
                'status' => false,
                'message' => 'Invalid credentials',
            ]);
        }

        $this->viewBuilder()->setOption('serialize', ['status', 'message', 'token']); */
    }

    /* protected function _generateJwtToken($user)
{
    $key = 'secret_key';
    $token = [
        'sub' => $user['id'],
        'exp' => time() + 3600,
    ];

    return JWT::encode($token, $key, 'HS256');
} */
}
