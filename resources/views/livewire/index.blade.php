<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
<div x-data="{ title: 'Hello World AlpineJS' }">
    <h1 x-text="title"></h1>
</div>


<div x-data="{ open: false }">
    <button
    @click="open = ! open"
    class="px-4 py-2 bg-blue-600 text-white rounded">
    Expand
</button>


    <div x-show="open">
        Content...
    </div>
</div>

<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle</button>

    <div x-show="open" x-transition>
        Hello 👋
    </div>
</div>


    <div class="collapse collapse-arrow bg-base-100 border border-base-300">
  <input type="radio" name="my-accordion-2" checked="checked" />
  <div class="collapse-title font-semibold">How do I create an account?</div>
  <div class="collapse-content text-sm">Click the "Sign Up" button in the top right corner and follow the registration process.</div>
</div>
<div class="collapse collapse-arrow bg-base-100 border border-base-300">
  <input type="radio" name="my-accordion-2" />
  <div class="collapse-title font-semibold">I forgot my password. What should I do?</div>
  <div class="collapse-content text-sm">Click on "Forgot Password" on the login page and follow the instructions sent to your email.</div>
</div>
<div class="collapse collapse-arrow bg-base-100 border border-base-300">
  <input type="radio" name="my-accordion-2" />
  <div class="collapse-title font-semibold">How do I update my profile information?</div>
  <div class="collapse-content text-sm">Go to "My Account" settings and select "Edit Profile" to make changes.</div>
</div>
</div>
