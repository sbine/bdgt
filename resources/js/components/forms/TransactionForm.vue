<template>
  <modal :value="creating || editing || deleting" @input="reset">
    <form ref="form" :method="formMethod" :action="formAction" @submit.prevent="save" dusk="transaction-form">
      <div class="sm:w-5/6 p-8">
        <template v-if="deleting">
          <h4 class="text-2xl mb-10">{{ $t('labels.transactions.modals.delete.title') }}</h4>

          <p class="text-red-700">{{ $t('labels.transactions.modals.delete.text') }}</p>
        </template>
        <template v-else>
          <h4 class="text-2xl mb-10">
            {{ editing ? $t('labels.transactions.modals.edit.title') : $t('labels.transactions.modals.create.title') }}
          </h4>

          <div class="form-row">
            <label class="form-row__label">{{ $t('labels.transactions.properties.date') }}</label>

            <div class="form-row__input">
              <input-datepicker v-model="transaction.date" name="date" required></input-datepicker>
            </div>
          </div>

          <div class="form-row">
            <label class="form-row__label">{{ $t('labels.transactions.properties.amount') }}</label>

            <div class="form-row__input input-addon--start">
              <span class="input-addon">$</span>
              <input
                v-model="transaction.amount"
                type="number"
                class="input-text pl-10"
                name="amount"
                step="0.01"
                min="0"
                max="1000000"
                required
              />
            </div>
          </div>

          <div class="form-row">
            <div class="form-row__label"></div>
            <div class="form-row__input">
              <label class="input-radio mr-4">
                <input v-model="transaction.inflow" class="mr-1" type="radio" name="inflow" :value="true" required />
                {{ $t('labels.transactions.properties.inflow') }}
              </label>
              <label class="input-radio">
                <input
                  v-model="transaction.inflow"
                  :checked="creating"
                  class="mr-1"
                  type="radio"
                  name="inflow"
                  :value="false"
                  required
                />
                {{ $t('labels.transactions.properties.outflow') }}
              </label>
            </div>
          </div>

          <div class="form-row">
            <label class="form-row__label">{{ $t('labels.transactions.properties.payee') }}</label>

            <div class="form-row__input">
              <input v-model="transaction.payee" type="text" class="input-text" name="payee" required />
            </div>
          </div>

          <div class="form-row">
            <label class="form-row__label">{{ $t('labels.transactions.properties.account_id') }}</label>

            <div class="form-row__input">
              <select v-model="transaction.account_id" class="input-text" name="account_id" required>
                <option v-for="(account, index) in accounts" :key="index" :value="account.id">
                  {{ account.name }}
                </option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <label class="form-row__label">{{ $t('labels.transactions.properties.category_id') }}</label>

            <div class="form-row__input">
              <select v-model="transaction.category_id" class="input-text" name="category_id">
                <option v-for="(category, index) in categories" :key="index" :value="category.id">
                  {{ category.label }}
                </option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <label class="form-row__label">{{ $t('labels.transactions.properties.bill_id') }}</label>

            <div class="form-row__input">
              <select v-model="transaction.bill_id" class="input-text" name="bill_id">
                <option
                  v-for="(bill, index) in bills"
                  :key="index"
                  :value="bill.id"
                  :selected="bill.id == transaction.bill_id"
                >
                  {{ bill.label }}
                </option>
              </select>
            </div>
          </div>

          <template v-if="creating">
            <input type="hidden" name="cleared" value="0" />
            <input type="hidden" name="flair" value="lightgray" />
          </template>
          <template v-else-if="editing">
            <div class="form-row">
              <div class="form-row__label"></div>
              <div class="form-row__input">
                <label class="input-checkbox">
                  <input type="hidden" name="cleared" value="0" />
                  <input v-model="transaction.cleared" type="checkbox" name="cleared" value="1" />
                  {{ $t('labels.transactions.properties.cleared') }}
                </label>
              </div>
            </div>
            <div class="form-row">
              <label class="form-row__label">{{ $t('labels.transactions.properties.flair') }}</label>

              <div class="form-row__input">
                <select v-model="transaction.flair" class="input-text" name="flair">
                  <option v-for="(flair, index) in flairs" :key="index">{{ flair }}</option>
                </select>
              </div>
            </div>
          </template>
        </template>
      </div>

      <div v-if="action" class="flex justify-end bg-gray-100 border-t border-gray-400 px-8 xl:px-10 py-6">
        <button type="button" class="link mr-6" @click="reset">
          {{ $t(`labels.transactions.modals.${action}.close_button`) }}
        </button>
        <button type="submit" class="button button--primary">
          {{ $t(`labels.transactions.modals.${action}.save_button`) }}
        </button>
      </div>
    </form>
  </modal>
</template>

<script>
import axios from 'axios'

export default {
  props: {
    accounts: { type: Array, required: true },
    bills: { type: Array, required: true },
    categories: { type: Array, required: true },
    flairs: { type: Array, required: true },
  },

  data() {
    return {
      id: null,
      action: null,
      transaction: {},
    }
  },

  computed: {
    formAction() {
      if (this.editing || this.deleting) {
        return `/api/transactions/${this.id}`
      }

      return '/api/transactions/create'
    },
    formMethod() {
      if (this.editing) {
        return 'PUT'
      }
      if (this.deleting) {
        return 'DELETE'
      }

      return 'POST'
    },
    creating() {
      return this.action === 'create'
    },
    editing() {
      return this.action === 'edit'
    },
    deleting() {
      return this.action === 'delete'
    },
    transactionAmount: {
      get() {
        return this.transaction
          ? this.transaction.inflow
            ? this.transaction.amount
            : -1 * this.transaction.amount
          : null
      },
      set(value) {
        this.transaction.amount = this.transaction.inflow ? value : -1 * value
      },
    },
  },

  methods: {
    async fetchTransaction() {
      await axios
        .get(`/api/transactions/${this.id}`)
        .then((response) => {
          this.transaction = response.data.data
        })
        .catch((error) => {
          console.log('Error fetching transaction', error)
        })
    },
    save() {
      if (!this.$refs.form.checkValidity()) {
        this.$refs.form.reportValidity()

        return false
      }

      axios({
        method: this.formMethod,
        url: this.formAction,
        data: {
          ...this.transaction,
        },
      })
        .then((response) => {
          this.reset()
          window.location.reload()
        })
        .catch((error) => {
          console.log('Error saving transaction', error)
        })
    },
    reset() {
      this.id = null
      this.action = null
    },
  },

  created() {
    this.$root.$on('editTransaction', async (id) => {
      this.id = id
      await this.fetchTransaction()
      this.action = 'edit'
    })
    this.$root.$on('deleteTransaction', (id) => {
      this.id = id
      this.action = 'delete'
    })
  },
}
</script>
