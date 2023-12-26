<?php


use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [Rule::requiredIf(fn () => !isset($this->email)), 'string'],
            'email' => [Rule::requiredIf(fn () => !isset($this->name)), 'email'],
            'password' => 'required|confirmed',
        ];
    }

    public function auth(): User|bool
    {
        if ($this->has('email')) {
            $attemptPayload = $this->only('email', 'password');
        } else {
            $attemptPayload = $this->only('name', 'password');
        }

        if (!Auth::attempt($attemptPayload)) {
            return false;
        }

        return $this->userRepository->findOne(['email' => $attemptPayload['email']]);
    }
}
