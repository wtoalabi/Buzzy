import Users from './MutateUsers'
import Content from './MutateContent'
import Uploads from './MutateUploads'
import Pages from './MutatePages'

export  default {
  ...Users,
  ...Content,
  ...Uploads,
  ...Pages
}