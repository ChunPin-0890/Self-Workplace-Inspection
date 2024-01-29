
<html>
    
<head>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body style="background-color:limegreen">
    <h1 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h1>
    <div x-data="{ count: 0 }">
        <button x-on:click="count++">Increment</button>
        <span x-text="count"></span>  
    </div>
    <br><br>
    {{-- Dropdown --}}
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle</button>
        <div x-show="open" @click.outside="open = false">Surprise mfs</div>
    </div>

    {{-- search --}}
    <div
    x-data="{
        search: '',
 
        items: ['foo', 'bar', 'baz'],
 
        get filteredItems() {
            return this.items.filter(
                i => i.startsWith(this.search)
            )
        }
    }"
><br><br>
    <input x-model="search" placeholder="Search...">
 
    <ul>
        <template x-for="item in filteredItems" :key="item">
            <li x-text="item"></li>
        </template>
    </ul>
</div>

<div>
    <ul x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">
        <template x-for="color in colors">
            <li x-text="color"></li>
        </template>
    </ul>
</div>

<div x-data>
    <button @click="alert('Alpine Js is working !')">Click</button>
</div>

<br>

<div x-data="{ message: '' }">
    <input type="text" x-model="message">
 
    <button x-on:click="message = 'changed'">Change Message</button>
</div>


<br>

<div x-data="{show:false}">
    <input type="checkbox" id="checkbox" x-model="show">
    <label for="checkbox" x-show="show" x-text="'Checkbox is checked'"></label>
</div>
<div x-data="{ colors: [] }">
{{-- checkboxs --}}
{{-- {ctrl+alt+arrown down/up to multi-select) --}}
<input type="checkbox" value="red" x-model="colors">
<input type="checkbox" value="orange" x-model="colors">
<input type="checkbox" value="yellow" x-model="colors">
Colors: <span x-text="colors"></span>
</div>
<br><br><br>

<div>
<input type="radio" value="yes" x-model="answer">
<input type="radio" value="no" x-model="answer">
 
Answer: <span x-text="answer"></span>
</div>
<br>
<div>
{{-- selected dropdown --}}
<select x-model="color">
    <option>Red</option>
    <option>Orange</option>
    <option>Yellow</option>
</select>
 
Color: <span x-text="color"></span>

</div>
<br>
<div x-data="{ color: '' }">
    <select x-model="color">
        <option value="" disabled>Select A Color</option>
        <option>Red</option>
        <option>Orange</option>
        <option>Yellow</option>
    </select>
 
    Color: <span x-text="color"></span>
</div>
<br>

<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle</button>
 
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
    >Hello 👋</div>
</div>

    <button @click="$refs.text.remove()">Remove Text</button>
<span x-ref="text">Hello 👋</span>

<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle Modal</button>

    <template x-teleport="body">
        <div x-show="open">
            Modal contents...
        </div>
    </template>
</div>

<div>Some other content placed AFTER the modal markup.</div>


<br>

<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle Modal</button>
 
    <template x-teleport="body">
        <div x-show="open">
            Modal contents...
 
            <div x-data="{ open: false }">
                <button @click="open = ! open">Toggle Nested Modal</button>
 
                <template x-teleport="body">
                    <div x-show="open">
                        Nested modal contents...
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>

<div x-data="dropdown">
    <button @click="toggle">...</button>
 
    <div x-show="open">Surprise mkfer</div>
</div>
 
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', () => ({
            open: false,
 
            toggle() {
                this.open = ! this.open
            }
        }))
    })
</script>

<pre>
    Come on 
                Dwight Howard
</pre>

<div class="min-w-screen min-h-screen bg-gray-100 flex items-start justify-center px-5 py-10" x-data="{showContextMenu:false}">
    <div class="relative" @click.away="showContextMenu=false">
        <button class="bg-white h-10 w-10 leading-10 text-center text-gray-800 text-xl shadow-md border border-gray-200 hover:border-gray-300 focus:border-gray-300 rounded-lg transition-all font-semibold outline-none focus:outline-none" x-on:contextmenu="$event.preventDefault();showContextMenu=true" @click.prevent="showContextMenu=false"><i class="mdi mdi-dots-horizontal"></i></button>
        <div class="absolute mt-12 top-0 left-1 min-w-full w-48 z-30" style="display:none;" x-show="showContextMenu" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
            <span class="absolute top-0 left-0 w-2 h-2 bg-white transform rotate-45 -mt-1 ml-3 border-gray-300 border-l border-t z-20"></span>
            <div class="bg-white overflow-auto rounded-lg shadow-md w-full relative z-10 py-2 border border-gray-300 text-gray-800 text-xs">
                <ul class="list-reset">
                    <li>
                        <a href="#" class="px-4 py-1 flex hover:bg-gray-100 no-underline hover:no-underline transition-colors duration-100" @click.prevent="showContextMenu=false">View Task</a>
                        <a href="#" class="px-4 py-1 flex hover:bg-gray-100 no-underline hover:no-underline transition-colors duration-100" @click.prevent="showContextMenu=false">Edit Task</a>
                        <a href="#" class="px-4 py-1 flex hover:bg-gray-100 no-underline hover:no-underline transition-colors duration-100 text-red-500" @click.prevent="showContextMenu=false">Delete Task</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>


<!-- BUY ME A BEER AND HELP SUPPORT OPEN-SOURCE RESOURCES -->
<div class="flex items-end justify-end fixed bottom-0 right-0 mb-4 mr-4 z-10">
    <div>
        <a title="Buy me a beer" href="https://www.buymeacoffee.com/scottwindon" target="_blank" class="block w-16 h-16 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
            <img class="object-cover object-center w-full h-full rounded-full" src="https://i.pinimg.com/originals/60/fd/e8/60fde811b6be57094e0abc69d9c2622a.jpg"/>
        </a>
    </div>
</div>

