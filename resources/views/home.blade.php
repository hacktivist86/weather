<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Home Page') }}
    </div>

    <table>
        <tr>
            <td>id</td>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <td>first_name</td>
            <td>{{ $user->first_name }}</td>
        </tr>
        <tr>
            <td>last_name</td>
            <td>{{ $user->last_name }}</td>
        </tr>
        <tr>
            <td>email</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>profile</td>
            <td>{{ $user->profile }}</td>
        </tr>
        <tr>
            <td>status</td>
            <td>{{ $user->status }}</td>
        </tr>
        <tr>
            <td>created_at</td>
            <td>{{ $user->created_at }}</td>
        </tr>
        <tr>
            <td>updated_at</td>
            <td>{{ $user->updated_at }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>temp</td>
            <td>{{ $weather?->temp }}</td>
        </tr>
        <tr>
            <td>pressure</td>
            <td>{{ $weather?->pressure }}</td>
        </tr>
        <tr>
            <td>humidity</td>
            <td>{{ $weather?->humidity }}</td>
        </tr>
        <tr>
            <td>temp_min</td>
            <td>{{ $weather?->temp_min }}</td>
        </tr>
        <tr>
            <td>temp_max</td>
            <td>{{ $weather?->temp_max }}</td>
        </tr>
    </table>
</x-guest-layout>
