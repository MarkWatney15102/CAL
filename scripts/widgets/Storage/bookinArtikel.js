$.widget('storage.bookinAritkel', {
    _create: function () {
        $('#bookIn').on('click', (e) => {
            const target = $(e.target);
            const ean = $('#ean').val();
            const amount = $('#amount').val();
            const row = $('#row').val();
            const position = $('#position').val();

            $.ajax(
                {
                    url: "/api/storage/bookin",
                    method: "POST",
                    dataType: "json",
                    data: JSON.stringify(
                        {
                            ean: ean ?? 0,
                            amount: amount ?? 0,
                            row: row ?? 0,
                            position: position ?? 0,
                            place: target.data('place') ?? 0
                        }
                    ),
                    success: (result) => {
                        if (result.message) {
                            let date = new Date();
                            date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
                            const expires = "; expires=" + date.toUTCString();

                            document.cookie = "message=" + result.message + expires + "; path=/";
                        }
                        location.reload();
                    }
                });
        });
    }
});