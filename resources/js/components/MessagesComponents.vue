<template>
    <div>
        <a class="p-3 d-flex border-bottom">
            <div class="  drop-img  cover-image  " data-image-src="">
                <span class="avatar-status bg-teal"></span>
            </div>
            <div class="wd-90p">
                <div class="d-flex">
                    <h5 class="mb-1 name">Petey Cruiser</h5>
                </div>
                <p class="mb-0 desc">I'm sorry but i'm not sure how to help you with that......</p>
                <p class="time mb-0 text-left float-right mr-2 mt-2">Mar 15 3:55 PM</p>
            </div>
        </a>
    </div>
</template>
<script>
    export default{
        name: 'MessagesComponents',
        data() {
            return {
                //
            }
        },
        mounted() {
            window.Echo.channel('Message').listen('MesagesEvent',function (event) {
            console.log(event);
            })
        },
    }
</script>
