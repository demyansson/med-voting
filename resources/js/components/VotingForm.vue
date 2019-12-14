<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form :action="action" method="post">
                    <input :value="method" name="_method" type="hidden">
                    <input :value="csrf" name="_token" type="hidden">

                    <div class="form-group">
                        <label for="votingFormTitle">Title</label>
                        <input class="form-control" id="votingFormTitle" name="title" type="text">
                    </div>

                    <div class="form-group">
                        <label for="votingFormDescription">Description</label>
                        <textarea class="form-control" id="votingFormDescription" name="description"
                                  rows="3"></textarea>
                    </div>

                    <hr>

                    <p>Options</p>

                    <div class="form-group">
                        <div :key="option.id" class="voting-option" v-for="(option, i) in options">
                            {{ i + 1 }}<input class="" name="options[]" type="text" v-model="option.title">
                            <button @click="removeOption(i)" class="btn btn-danger" type="button">Remove</button>
                        </div>
                        <button @click="addOption" class="btn btn-dark" type="button">Add option</button>
                    </div>

                    <button class="btn btn-primary" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            csrf: {
                type: String
            },
            action: {
                type: String,
                default: ''
            },
            method: {
                type: String,
                default: 'post'
            },
        },
        data: function () {
            return {
                options: [
                    {id: 1, title: "Option 1"},
                    {id: 2, title: "Option 2"}
                ]
            };
        },
        methods: {
            addOption() {
                let optionId = this.options.length + 1;

                this.options.push({id: optionId, title: "Option " + optionId});
            },
            removeOption(i) {
                this.options.splice(i, 1);
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style>
    .voting-option {
    }

    .voting-option input {
        border-radius: 3px;
        border: 1px solid #b8b8b8;
        margin: 10px;
        padding: 5px;
    }
</style>
