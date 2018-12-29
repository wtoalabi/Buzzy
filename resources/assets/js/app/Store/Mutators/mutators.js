import Users from './MutateUsers'
import Content from './MutateContent'
import Uploads from './MutateUploads'

export  default {
  ...Users,
  ...Content,
  ...Uploads
}