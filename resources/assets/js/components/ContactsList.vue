<template>
    <div class="contacts-list">
        <ul>
            <li v-for="contact in contacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact == selected }">
            <div class="avatar">
                    <img :src="contact.profile_image" :alt="contact.name">
                </div>
                <div class="contact">
                    <p class="name">{{ contact.name }}</p>
                    <p class="email">{{ contact.email }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "ContactsList.vue",
        props: {
            contacts: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;
                this.$emit('selected', contact);
            }
        },
    }
</script>

<style scoped>

</style>