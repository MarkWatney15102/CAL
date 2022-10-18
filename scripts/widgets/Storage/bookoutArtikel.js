$.widget('storage.bookoutAritkel', {
    _create: function () {
        $('.bookoutButton').on('click', (e) => {
            const target = $(e.target);
            const placeId = target.data('place');
            const bookOutEan = target.data('ean');
            const row = target.data('row');
            const position = target.data('position');
            const selector = '#bookoutAmount' + bookOutEan + "_" + row + "_" + position;
            const bookOutAmount = $(selector).val();

            $.ajax(
                {
                    url: "/api/storage/bookout",
                    method: "POST",
                    dataType: "json",
                    data: JSON.stringify(
                        {
                            place: placeId,
                            bookOutEan: bookOutEan ?? 0,
                            bookOutAmount: bookOutAmount ?? 0,
                            row: row ?? 0,
                            position: position ?? 0
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
                }
            )
        });
    }
});