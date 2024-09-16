<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-3 fs-4 fw-bold">{{ __("Contacts Table") }}</div>
                    <form class="d-flex" role="search" id="seach">
                        <input class="" type="search" name="search" placeholder="Search">
                    </form>
                    </div>

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">NAME</th>
                            <th scope="col">COMPANY</th>
                            <th scope="col">PHONE</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody id="tbody">

                          @foreach ($contacts as $contact)
                          <tr>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->company}}</td>
                            <td>{{$contact->number}}</td>
                            <td>{{$contact->email}}</td>
                            <td>
                              <a href="/contacts/edit/{{$contact->id}}" class="text-primary">Edit</a>
                              <span class="border-end border-dark-subtle"></span>
                              <button value="{{$contact->id}}" class="text-danger ms-1 btn-delete">Delete</button>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
            <div class="mt-3">
              {{ $contacts->links() }}
            </div>
        </div>
        
    </div>
</x-app-layout>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this contact?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="btn-yes">Yes</button>
      </div>
    </div>
  </div>
</div>

<script>

  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
  $('.btn-delete').click(function(){
      const id = $(this).val();
      $('#exampleModal').modal('show');
  
      $('#btn-yes').off().click(function(){
        $.ajax({
            type: 'DELETE',
            url: '/deleteContacts/' + id,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(res) {
                console.log(res);
                $('#exampleModal').modal('hide');
                location.reload();
            },
            error: function(err) {
                console.error('Error deleting item:', err);
            }
        });
      });
  });

  $('#seach').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: '/contacts/search',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function(result) {
            console.log(result);

            // Clear tbody only once
            $('#tbody').empty();
            
            // Append rows to tbody
            result.contacts.data.forEach(contact => {
                $('#tbody').append(`
                    <tr>
                        <td>${contact.name}</td>
                        <td>${contact.company}</td>
                        <td>${contact.number}</td>
                        <td>${contact.email}</td>
                        <td>
                            <a href="/contacts/edit/${contact.id}" class="text-primary">Edit</a>
                            <span class="border-end border-dark"></span>
                            <button value="${contact.id}" class="text-danger ms-1 btn-delete">Delete</button>
                        </td>
                    </tr>
                `);
            });
        },
        error: function (xhr, status, error) {
            console.error('Error: ' + error);
            console.error('Status: ' + status);
            console.error('Response: ' + xhr.responseText);
        }
    });

    $(this).addClass('was-validated');
});

  </script>