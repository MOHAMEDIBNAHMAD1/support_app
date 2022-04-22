 <x-admin-layout>
 <x-slot name="header">
   </x-slot>
   <!-- ticket -->

   <div class="flex bg-white shadow-lg rounded-lg mx-52 md:mx-auto  mt-5 max-w-md md:max-w-2xl  ">
      <!--horizantil margin is just for display-->
      <div class="flex items-start px-4 py-4 pt-0 ">


         <img class="w-12 h-12 rounded-full object-cover mr-4 shadow"
            src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
            alt="avatar">
         <div class="">
            <div class="flex items-center justify-between">
               <h2 class="text-lg font-semibold text-gray-900 -mt-1"> {{ $user->Users->name}} </h2>
               <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded ">
                  {{$ticket->statuses->name}}
               </span>
               <small class="text-sm text-gray-700">{{ $ticket->created_at->diffForHumans() }}</small>
            </div>
            <p class="text-gray-700"> Joined at {{ $user->Users->created_at->diffForHumans() }} </p>
            <div class="">
               <h2 class="text-lg font-semibold text-gray-800 -mt-1">{{ $ticket->title }} </h2>
               <p class="mt-3 text-gray-700 text-sm w-70" style="width: 486px;">
                  {!! html_entity_decode( $ticket->description ) !!}
            </div>
            <hr class="divide-y divide-gray-200">
            <div class="mt-4 flex items-center">
               </form>

            </div>

            @if ($ticket->statuses->name == 'Nouveau')
            <div class="flex  items-center justify-center ">
               <form class="" method="POST" action="{{ route('admin.comment.store') }}">
                  @csrf
                  <input type="hidden" name="is_admin" value="1">
                  {{-- id admin --}}
                  
                  <div class="flex flex-wrap -mx-3 mb-6">
                     <h2 class="px-4 pt-3 pb-2 text-gray-800 text-lg">Add a new comment</h2>
                     <div class="w-full md:w-full px-3 mb-2 mt-2">
                        <input type='hidden' name="user_id" value="">
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <textarea name="comment"
                           class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                           name="body" placeholder='Type Your Comment' required></textarea>
                     </div>
                     <div class="w-full md:w-full flex items-start  px-3">
                        <div class="flex items-start w-1/2 text-gray-700 px-2 mr-auto">

                        </div>
                        <div class="-mr-1">
                           <input type='submit'
                              class=" text-white font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:border-gray-600 bg-emerald-400"
                              value='Post Comment'>
                        </div>
                     </div>
               </form>
            </div>
            @endif
         </div>
      

         <hr class="divide-y divide-gray-200">

         @foreach ($commentsuser as $comment)
         <div class="relative flex items-start space-x-6 pl-6 py-2 rounded-lg  ">
           
            <div class="shrink-0">
               <img class="md:h-12 md:w-12 lg:h-12 lg:w-12 h-10 w-10 object-cover rounded-full"
                  src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                  alt="Current profile photo" />
            </div>
            <div class='flex flex-col bg-gray-100 w-9/12 rounded-lg px-4 pb-3 '>
               <div class="flex items-center justify-between  mt-3">
                  <h2 class="text-lg font-semibold text-gray-900">
                     {{ $user->Users->name}}
                  </h2>

                  </span>

                  @if ($comment->check_is_finsh = 1 )
                  <form method="post" action="{{ route('admin.tickte.update', $ticket->id) }}">
                     @csrf
                    @method('PUT')
                     <input type="hidden" name="statusid" value="3">
                     <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                     <button type="submit"
                        class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded ">
                        Fisher
                     </button>
                  
                  @endif

                 
                    
                     {{-- <button type='submit'
                        class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold text-red-500  rounded">Delete</button> --}}
               </div>
               <p class="text-gray-500"> created at {{$comment->created_at->diffForHumans() }}</p>
               <div class='md:text-sm text-xs  '>{{ $comment->comment }}</div>
            </div>

            </form>
         </div>
         @endforeach

         @foreach ($commentsadmin as $comment)
         <div class="flex items-start space-x-6 pl-6 py-2 rounded-lg  ">
            <div class='flex flex-col bg-gray-100 w-9/12 rounded-lg px-3 pb-3 '>
               <div class="title-font text-sm md:text-base flex items-center   lg:text-1xl font-bold pt-3 text-gray-900"> 
                 <div> {{ $admin }} </div>
                <samp><img class="w-5 h-5 rounded-full" src="https://image.similarpng.com/very-thumbnail/2021/05/Blue-check-mark-sign-illustration-on-transparent-background-PNG.png" alt="Rounded avatar"></samp>
             
               </div>
              
               <div class='md:text-sm text-xs  '>
                  {{ $comment->comment }}
               </div>
            </div>
            <div class="shrink-0">

               <img class="md:h-12 md:w-12 lg:h-12 lg:w-12 h-10 w-10 object-cover rounded-full"
                  src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1361&q=80"
                  alt="Current profile photo" />
            </div>
         </div>
         @endforeach
      </div>
   </div>
   @include('admin.layouts.message')

</x-admin-layout>