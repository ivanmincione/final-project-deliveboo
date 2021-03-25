@extends('layouts.dashboard')

@section('admin.content')
<div id="root">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col 12">
                <h1>lista piatti del ristorante</h1>
                <a href="{{ route('admin.dishes.create') }}">
                    <button type="button" class="btn btn-info">Aggiungi nuovo piatto</button>
                </a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($restaurants) > 1)
                            <h3>seleziona il tuo ristorante</h3>
                            <select @change="onChange(this.value)" v-model="selectedValue">
                                <option value="">seleziona ristorante</option>
                                @foreach ($restaurants as $restaurant)
                                    <option value="{{$restaurant->id}}">{{ $restaurant->name }}</option>
                                @endforeach
                            </select>
                                <tr v-for="dish in dishes" v-if="visible && dish.restaurant_id == selectedValue">
                                    <td>@{{ dish.id }}</td>
                                    <td>@{{ dish.name }}</td>
                                    <td>@{{ dish.slug }}</td>
                                    {{-- {{ dd($dishes[0]) }} --}}
                                    {{-- @php $variabile = '';
                                    @endphp --}}
                                    <td>
                                        <a href="" :route="rotta1" >
                                            <button class="btn btn-info">click</button>
                                        </a>
                                    </td>
                                    {{-- @foreach ($dishes as $dish)
                                        @foreach ($dish as $item)

                                        <td>
                                            <a href="{{ route('admin.dishes.show', ['dish'=> $item->slug ]) }}">
                                                <button class="btn btn-primary">Show</button>
                                            </a>
                                            <a href="{{ route('admin.dishes.edit', ['dish'=>$item->slug ]) }}">
                                                <button class="btn btn-info">Modify</button>
                                            </a>
                                            <form class="d-inline"
                                            action="{{ route('admin.dishes.destroy', ['dish'=>$item->slug]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                        @endforeach
                                    @endforeach --}}
                                </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var app = new Vue ({
    el: '#root',
    data: {
        selectedValue: '',
        changedValue: '',
        visible: false,
        dishes: [],
        rotta1: "{{ route('admin.dishes.index' ]) }}",

    },
    methods: {
        onChange(value) {
            this.visible = false;

            console.log(this.selectedValue);

            axios.post('/api/dishes')
            .then((element) => {
                // this.dishes = response.data.dishes;
                console.log(element.data.response);
                console.log(element.data);
                this.dishes = element.data.response;
                for (var i = 0; i < element.data.response.length; i++) {
                    console.log(element.data.response[i].restaurant_id);
                    this.changedValue = element.data.response[i].restaurant_id;
                    if (this.selectedValue == this.changedValue) {
                        this.visible = true;
                    }
                }
            })
        },
    },
    mounted() {

    }
})
</script>
@endsection
