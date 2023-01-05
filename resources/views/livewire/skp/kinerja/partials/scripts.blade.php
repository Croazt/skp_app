    <script src="{{ asset('stisla/js/page/bootstrap-modal.js') }}"></script>
    <script>
        function rowspanSelector() {
            const table = document.querySelector('table');
            let headerCell = null;
    
            let kinerjaAtasanRow = $('.deskripsi')
            for (let i = 0; i < kinerjaAtasanRow.length; i++) {
                const firstCell = (kinerjaAtasanRow[i])
                if (headerCell === null || firstCell.innerText !== headerCell.innerText) {
                    headerCell = firstCell;
                } else {
                    headerCell.rowSpan += 3;
                    firstCell.remove();
                }
            }
        }
        rowspanSelector()
        function findBlocks(theTable) {
            if ($(theTable).data('hasblockrows') == null) {
                // to prove we only run this once

                // we will loop through the rows but skip the ones not in a block
                var rows = $(theTable).find('tr');
                var maxRowspanAdd = 0;
                for (var i = 0; i < rows.length;) {
                    var maxRowspanSec = 0;

                    var firstRow = rows[i];

                    // find max rowspan in this row - this represents the size of the block
                    var maxRowspan = 1;
                    $(firstRow).find('td').each(function() {
                        if ($(this).hasClass('deskripsi')) {
                            maxRowspanSec = parseInt($(this).attr('rowspan') || '1', 10)
                            return
                        }
                        var attr = parseInt($(this).attr('rowspan') || '1', 10)
                        if (attr > maxRowspan) maxRowspan = attr;
                    });

                    // set to the index in rows we want to go up to
                    maxRowspan += i;
                    var blockRows = []
                    var parentBlockRows = []
                    if (maxRowspanSec == 1) {
                        blockRows.push($(firstRow).children()[0]);
                        blockRows.push(rows[i]);
                        parentBlockRows.push(rows[i]);
                        $(rows[i]).data('blockrows', blockRows);
                        $($(firstRow).children()[0]).data('blockrows', blockRows)
                        $($(firstRow).children()[0]).data('parentblockrows', parentBlockRows)
                        maxRowspanAdd++
                        i++
                        continue
                    }
                    // build up an array and store with each row in this block
                    // this is still memory-efficient, as we are just storing a pointer to the same array
                    // ... which is also nice becuase we can build the array up in the same loop

                    blockRows.push($(firstRow).children()[0]);
                    for (; i < maxRowspan; i++) {
                        $(rows[i]).data('blockrows', blockRows);
                        blockRows.push(rows[i]);
                        parentBlockRows.push(rows[i]);
                    }
                    if (maxRowspanSec > 3) {
                        for (let j = 1; j <= (maxRowspanSec / 3) - 1; j++) {
                            blockRows = []
                            blockRows.push($(firstRow).children()[0]);
                            var temp = i + 3
                            for (; i < temp; i++) {
                                $(rows[i]).data('blockrows', blockRows);
                                blockRows.push(rows[i]);
                                parentBlockRows.push(rows[i]);
                            }
                            $($(firstRow).children()[0]).data('blockrows', blockRows)
                            $($(firstRow).children()[0]).data('parentblockrows', parentBlockRows)
                        }
                    }
                    // i is now the start of the next block
                }

                // set data against table so we know it has been inited (for if we call it in the hover event)
                $(theTable).data('hasblockrows', 1);
            }
        }
        findBlocks($('table'));
            $(".table-complex td").hover(function() {
                $el = $(this);
                //findBlocks($el.closest('table')); // you can call it here or onload as below
                if (!$el.hasClass('deskripsi')) {
                    $.each($el.parent().data('blockrows'), function() {

                        if ($(this).hasClass('deskripsi')) {
                            $(this).addClass('hover');
                        }
                        $(this).find('td').addClass('hover');
                    });
                } else {
                    $.each($el.data('parentblockrows'), function() {
                        $(this).find('td').addClass('hover');
                    });
                }
            }, function() {
                $el = $(this);
                if (!$el.hasClass('deskripsi')) {
                    $.each($el.parent().data('blockrows'), function() {
                        if ($(this).hasClass('deskripsi')) {
                            $(this).removeClass('hover');
                        }
                        $(this).find('td').removeClass('hover');
                    });
                } else {
                    $.each($el.data('parentblockrows'), function() {
                        $(this).find('td').removeClass('hover');
                    });
                }
            });
    </script>
